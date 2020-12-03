import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import moment from "moment";
import {
  Table,
  Tag,
  Space,
  Button,
  Avatar,
  Popconfirm,
  Form,
  Modal,
  message,
  Typography,
  Select,
  Empty,
} from "antd";
import MainLayout from "../Layouts/MainLayout";
import {
  CheckCircleFilled,
  DeleteFilled,
  DeleteOutlined,
  EditFilled,
  EditOutlined,
  UserAddOutlined,
  UserOutlined,
} from "@ant-design/icons";
import FormUpdateUser from "./Components/FormUpdateUser";
import FormAddUser from "./Components/FormAddUser";

const axios = require("axios").default;

function UserIndex(props) {
  const dateFormat = "DD-MM-YYYY";
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(false);
  const [filters, setFilters] = useState({});
  const [sorters, setSoters] = useState({});
  const [pagination, setPagination] = useState({
    pageSize: 10,
    current: 1,
    total: 1,
  });

  const [modalUpdateVisible, setModalUpdateVisible] = useState(false);
  const [modalAddVisible, setModalAddVisible] = useState(false);
  const [formUpdate] = Form.useForm();
  const [formAdd] = Form.useForm();

  const headerButtons = () => {
    return [
      <Button
        key="add_user"
        type="primary"
        icon={<UserAddOutlined />}
        size={"large"}
        onClick={() => setModalAddVisible(true)}
      >
        Thêm người dùng
      </Button>,
    ];
  };

  const columns = [
    {
      title: "ID",
      dataIndex: "id",
      key: "id",
      sorter: true,
      render: (id) => id,
      width: "50px",
    },
    {
      title: "Ảnh đại diện",
      dataIndex: "avatar",
      key: "avatar",
      align: "center",
      render: (avatar) => (
        <Avatar shape="square" size="large" icon={<UserOutlined />} />
      ),
    },
    {
      title: "Người dùng",
      dataIndex: "full_name",
      key: "full_name",
      sorter: true,
      render: (text) => <a>{text}</a>,
    },
    {
      title: "Tài khoản",
      dataIndex: "username",
      key: "username",
    },
    {
      title: "Loại tài khoản",
      key: "role",
      dataIndex: "role_id",
      filters: [
        { text: "Admin", value: "administrator" },
        { text: "Manager", value: "manager" },
      ],
      render: (role_id) => {
        let _color = "";
        let _role = props.appData.role_list.filter((role) => {
          return role.id === role_id;
        })[0];

        switch (parseInt(_role.level)) {
          case 1:
            _color = "red";
            break;
          case 2:
            _color = "blue";
            break;
          default:
            _color = "grays";
            break;
        }
        return (
          <Tag color={_color} key="role">
            {_role.name}
          </Tag>
        );
      },
    },
    {
      title: "Ngày sinh",
      dataIndex: "birthday",
      key: "birthday",
      sorter: true,
    },
    {
      title: "Tùy chọn",
      key: "id",
      render: (text, record) => (
        <Space size="middle">
          <Button
            icon={<EditFilled />}
            style={{ color: "orange", borderColor: "orange" }}
            onClick={() => loadUserInfo(record.id)}
          />
          <Popconfirm
            title="Bạn có chắc muốn xóa người dùng này?"
            onConfirm={() => handleDeleteUser(record.id)}
            okText="Xóa"
            okButtonProps={{ danger: true }}
            cancelText="Hủy"
            align="right"
            icon={<DeleteOutlined style={{ color: "red" }} />}
          >
            <Button icon={<DeleteFilled />} danger />
          </Popconfirm>
        </Space>
      ),
    },
  ];

  const handleTableChange = (
    inputPagination = {},
    inputFilters = {},
    inputSorter = {}
  ) => {
    let _params = {};

    _params = {
      ...inputPagination,
      sortField: inputSorter.field,
      sortOrder: inputSorter.order,
      filters: inputFilters,
    };
    setSoters({
      sortField: inputSorter.field,
      sortOrder: inputSorter.order,
    });
    setPagination({ ...inputPagination });
    setFilters(inputFilters);
    setLoading(true);
    axios
      .get("api/users", { params: _params })
      .then((response) => {
        let newDataSource = Object.assign([], response.data.data);

        newDataSource.map((value) => {
          let tmpValue = value;
          tmpValue.key = value.id;
          return tmpValue;
        });
        setData(newDataSource);
        setPagination({
          ...pagination,
          total: response.data.total,
          current: response.data.current,
        });
        setLoading(false);
      })
      .catch((error) => {
        setLoading(false);
        if (error.response.data.status !== undefined) {
          message.error(error.response.data.messages.error);
          return false;
        }
        message.error("Đã có lỗi xảy ra!");
      });
  };
  const renderRoleList = () => {
    return props.appData.role_list.map((role) => {
      return (
        <Select.Option
          key={role.name}
          value={role.id}
          style={{ textTransform: "capitalize" }}
        >
          {role.name}
        </Select.Option>
      );
    });
  };
  const handleDeleteUser = (userID) => {
    let _params = {};

    _params = {
      ...pagination,
      sortField: sorters.sortField,
      sortOrder: sorters.sortOrder,
      filters: filters,
    };
  };

  const loadUserInfo = (userID) => {
    axios.get(`api/users/${userID}/edit`).then((res) => {
      let newFormValue = {
        username: res.data.username,
        full_name: res.data.full_name,
        birthday: moment(res.data.birthday, dateFormat),
        role: res.data.role_id
      };
      
      formUpdate.setFieldsValue(newFormValue);
    });
    setModalUpdateVisible(true);
  };

  const handleUpdateUser = (values) => {
    setLoading(true);
    console.log(values);
  };
  const handleAddUser = (values) => {
    console.log(values);
  };

  useEffect(() => {
    axios.defaults.headers.common["Content-Type"] = "application/json";
    axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

    handleTableChange(pagination);
  }, []);

  return (
    <MainLayout {...props.appData} headerButtons={headerButtons()}>
      <Table
        columns={columns}
        dataSource={data}
        loading={loading}
        pagination={{
          total: pagination.total,
          current: pagination.current,
          pageSize: pagination.pageSize,
        }}
        onChange={handleTableChange}
        locale={{
          filterConfirm: "Lọc",
          filterReset: "Bỏ lọc",
          emptyText: <Empty description="Không có dữ liệu" />,
          filterTitle: "Lọc",
          sortTitle: "Sắp xếp",
          triggerAsc: "Tăng dần",
          triggerDesc: "Giảm dần",
          cancelSort: "Huỷ sắp xếp"
        }}
      />
      <Modal
        title={
          <Space>
            <EditOutlined style={{ fontSize: "24px", color: "#1890ff" }} />
            <Typography.Text style={{ color: "#1890ff" }} strong={true}>
              CẬP NHẬT NGƯỜI DÙNG
            </Typography.Text>
          </Space>
        }
        centered
        visible={modalUpdateVisible}
        closable={false}
        footer={[
          <Button key="back" onClick={() => setModalUpdateVisible(false)}>
            Hủy
          </Button>,
          <Button
            key="submit"
            type="primary"
            loading={loading}
            onClick={() => formUpdate.submit()}
            icon={<CheckCircleFilled />}
          >
            Cập Nhật
          </Button>,
        ]}
      >
        <FormUpdateUser
          form={formUpdate}
          dateFormat={dateFormat}
          onFinish={handleUpdateUser}
          roleOptionList={renderRoleList()}
        />
      </Modal>
      <Modal
        title={
          <Space>
            <UserAddOutlined style={{ fontSize: "24px", color: "#1890ff" }} />
            <Typography.Text style={{ color: "#1890ff" }} strong={true}>
              THÊM NGƯỜI DÙNG
            </Typography.Text>
          </Space>
        }
        centered
        closable={false}
        visible={modalAddVisible}
        footer={[
          <Button key="back" onClick={() => setModalAddVisible(false)}>
            Hủy
          </Button>,
          <Button
            key="submit"
            type="primary"
            loading={loading}
            onClick={() => formAdd.submit()}
            icon={<CheckCircleFilled />}
          >
            Thêm
          </Button>,
        ]}
      >
        <FormAddUser
          form={formAdd}
          dateFormat={dateFormat}
          onFinish={handleAddUser}
          roleOptionList={renderRoleList()}
        />
      </Modal>
    </MainLayout>
  );
}

(function() {
  ReactDOM.render(
    <UserIndex appData={JSON.parse(appData.value)} />,
    document.getElementById("app")
  );
  document.querySelector("body").removeChild(appData);
})();

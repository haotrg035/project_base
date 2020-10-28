import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import { Table, Tag, Space, Button, Avatar } from "antd";
import MainLayout from "../Layouts/MainLayout";
import {
  DeleteFilled,
  EditFilled,
  UserAddOutlined,
  UserOutlined,
} from "@ant-design/icons";
const axios = require("axios").default;

const columns = [
  {
    title: "ID",
    dataIndex: "id",
    key: "id",
    render: (id) => id,
  },
  {
    title: "Ảnh đại diện",
    dataIndex: "avatar",
    key: "avatar",
    align: "center",
    render: (avatar) => (
      <>
        <Avatar shape="square" size="large" icon={<UserOutlined />} />
      </>
    ),
  },
  {
    title: "Người dùng",
    dataIndex: "full_name",
    key: "full_name",
    render: (text) => <a>{text}</a>,
  },
  {
    title: "Tài khoản",
    dataIndex: "username",
    key: "username",
  },
  {
    title: "Chức vụ",
    key: "role",
    dataIndex: "role",
    render: (role) => {
      let _color = "gray";
      let _roleLevel = parseInt(role["level"]);
      if (_roleLevel === 1) {
        _color = "red";
      } else if (_roleLevel === 2) {
        _color = "blue";
      }
      return (
        <>
          <Tag color={_color} key="role">
            {role["name"]}
          </Tag>
        </>
      );
    },
  },
  {
    title: "Ngày sinh",
    dataIndex: "birthday",
    key: "birthday",
  },
  {
    title: "Tùy chọn",
    key: "id",
    render: (text, record) => (
      <Space size="middle">
        <Button
          icon={<EditFilled />}
          style={{ color: "orange", borderColor: "orange" }}
        />
        <Button icon={<DeleteFilled />} danger />
      </Space>
    ),
  },
];

const headerButtons = () => {
  return [
    <Button
      key="add_user"
      type="primary"
      icon={<UserAddOutlined />}
      size={"large"}
    >
      Thêm người dùng
    </Button>,
  ];
};

function UserIndex(props) {
  const [data, setData] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [pageTotal, setPageTotal] = useState(1);

  useEffect(() => {
    const _data = Object.assign([], props.appData.data.user.data);

    _data.map((value) => {
      let tmpValue = value;
      tmpValue.key = value.id;
      return tmpValue;
    });
    setData(_data);
    setCurrentPage(props.appData.data.user.page);
    setPageTotal(props.appData.data.user.total);
  }, []);

  const changePage = (pos) => {
    axios
      .get("/admin/users", {
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        params: {
          page: pos,
        },
      })
      .then((response) => {
        let newDataSource = Object.assign([], response.data.data);
        
        newDataSource.map((value) => {
          let tmpValue = value;
          tmpValue.key = value.id;
          return tmpValue;
        });
        setData(newDataSource);
        setCurrentPage(response.data.page);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  return (
    <MainLayout {...props.appData} headerButtons={headerButtons()}>
      <Table
        columns={columns}
        dataSource={data}
        pagination={{
          total: pageTotal,
          current: currentPage,
        }}
        onChange={(e) => changePage(e.current)}
      />
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

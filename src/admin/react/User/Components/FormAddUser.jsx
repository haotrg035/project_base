import React from "react";
import { DatePicker, Form, Input, Select } from "antd";

function FormAddUser(props) {
  const formItemLayout = {
    labelCol: {
      xs: { span: 24 },
      sm: { span: 8 },
    },
    wrapperCol: {
      xs: { span: 24 },
      sm: { span: 16 },
    },
  };

  return (
    <Form
      {...formItemLayout}
      form={props.form}
      name="FormAddUser"
      onFinish={props.onFinish}
      scrollToFirstError={true}
    >
      <Form.Item
        name="full_name"
        label="Họ và Tên"
        rules={[{ required: true, message: "Vui lòng nhập họ tên người dùng" }]}
      >
        <Input placeholder="Nhập họ tên người dùng" />
      </Form.Item>
      <Form.Item
        name="username"
        label="Tài khoản"
        rules={[{ required: true, message: "Vui lòng nhập tên tài khoản" }]}
      >
        <Input placeholder="Nhập họ tên tài khoản" />
      </Form.Item>
      <Form.Item
        name="password"
        label="Mật khẩu"
        rules={[
          {
            required: true,
            message: "Vui lòng nhập mật khẩu!",
          },
        ]}
        hasFeedback
      >
        <Input.Password placeholder="Nhập mật khẩu" />
      </Form.Item>

      <Form.Item
        name="confirm_passworđ"
        label="Xác nhận mật khẩu"
        dependencies={["password"]}
        hasFeedback
        rules={[
          {
            required: true,
            message: "Vui lòng xác nhận lại mật khẩu!",
          },
          ({ getFieldValue }) => ({
            validator(rule, value) {
              if (!value || getFieldValue("password") === value) {
                return Promise.resolve();
              }
              return Promise.reject("Mật khẩu xác nhận không trùng khớp.");
            },
          }),
        ]}
      >
        <Input.Password placeholder="Nhập lại mật khẩu" />
      </Form.Item>
      <Form.Item
        name="birthday"
        label="Ngày sinh"
        rules={[
          {
            required: true,
            message: "Vui lòng cung cấp ngày sinh.",
          },
        ]}
      >
        <DatePicker placeholder="Chọn ngày sinh" format="DD-MM-YYYY" />
      </Form.Item>
      <Form.Item
        name="role"
        label={"Loại tài khoản"}
        rules={[
          {
            required: true,
            message: "Vui lòng cho biết loại tài khoản.",
          },
        ]}
      >
        <Select
          placeholder="Chọn chức vụ"
          style={{ textTransform: "capitalize" }}
        >
          {props.roleOptionList}
        </Select>
      </Form.Item>
    </Form>
  );
}

export default FormAddUser;

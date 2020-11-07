import React from "react";
import { DatePicker, Form, Input, Select } from "antd";

function FormUpdateUser(props) {
  const formItemLayout = {
    labelCol: {
      xs: { span: 24 },
      sm: { span: 6 },
    },
    wrapperCol: {
      xs: { span: 24 },
      sm: { span: 18 },
    },
  };

  return (
    <Form
      {...formItemLayout}
      form={props.form}
      name="formUpdateUser"
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
        name="birthday"
        label="Ngày sinh"
        rules={[
          {
            required: true,
            message: "Vui lòng cung cấp ngày sinh.",
          },
        ]}
      >
        <DatePicker placeholder="Chọn ngày sinh" format="DD/MM/YYYY" />
      </Form.Item>
      <Form.Item
        name="role"
        label={"Chức vụ"}
        rules={[
          {
            required: true,
            message: "Vui lòng cho biết chức vụ của người dùng.",
          },
        ]}
      >
        <Select placeholder="Chọn chức vụ">
          <Select.Option value="1">Administrator</Select.Option>
          <Select.Option value="2">Manager</Select.Option>
        </Select>
      </Form.Item>
    </Form>
  );
}

export default FormUpdateUser;

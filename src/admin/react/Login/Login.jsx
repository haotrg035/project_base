import "antd/dist/antd.css";
import { Form, Input, Checkbox, Button, Card } from "antd";
import { LoginOutlined, LockOutlined } from "@ant-design/icons";

import React from "react";
import ReactDOM from "react-dom";

const onFinish = (values) => {
  console.log("Success:", values);
};

const onFinishFailed = (errorInfo) => {
  console.log("Failed:", errorInfo);
};

const layout = {
  labelCol: { span: 8 },
  wrapperCol: { span: 16 },
};

function Login(props) {
  return (
    <>
      <h2
        style={{
          padding: "12px 24px",
          margin: "0",
          background: "#FFF",
          border: "1px solid rgb(240, 240, 240)",
          borderBottom: "none",
          display: "flex",
          alignItems: "center",
          justifyContent: "space-between",
          color:'var(--antd-wave-shadow-color)'
        }}
      >
        <LockOutlined style={{ marginRight: 12, color:'var(--antd-wave-shadow-color)' }} />
        <span>ĐĂNG NHẬP</span>
      </h2>
      <Card style={{ width: 360 }}>
        <Form
          name="basic"
          {...layout}
          initialValues={{ remember: true }}
          onFinish={onFinish}
          onFinishFailed={onFinishFailed}
        >
          <Form.Item
            label="Tài khoản"
            name="username"
            labelAlign={"left"}
            rules={[
              { required: true, message: "Vui lòng nhập tên tài khoản!" },
            ]}
          >
            <Input placeholder={"Nhập tên tài khoản"} />
          </Form.Item>

          <Form.Item
            label="Mật khẩu"
            labelAlign={"left"}
            name="password"
            rules={[{ required: true, message: "Vui lòng nhập mật khẩu!" }]}
          >
            <Input.Password placeholder={"Nhập mật khẩu"} />
          </Form.Item>

          <Form.Item
            wrapperCol={{
              md: { offset:8,span: 16 },
            }}
            name="remember"
            valuePropName="checked"
          >
            <Checkbox>Ghi nhớ</Checkbox>
          </Form.Item>

          <Form.Item
            wrapperCol={{offset:8, span: 24 }}
            style={{ margin: 0 }}
          >
            <Button icon={<LoginOutlined />} type="primary" htmlType="submit">
              Đăng Nhập
            </Button>
          </Form.Item>
        </Form>
      </Card>
    </>
  );
}
export default Login;
ReactDOM.render(<Login></Login>, document.getElementById("app"));

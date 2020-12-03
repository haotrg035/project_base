import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import MainLayout from "../Layouts/MainLayout";
import {Row,Col} from 'antd';
const axios = require('axios').default;

function RoleIndex(props) {
  const [roleList, setRoleList] = useState([]);

  useEffect(() => {
    axios.defaults.headers.common["Content-Type"] = "application/json";
    axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    axios.get('api/roles')
    .then(respond => {
      console.log(respond);
    })
    .catch(err => {
      console.log(err);
    })
  }, [])

  return (
    <MainLayout {...props.appData}>
      <Row>
        <Col span={8}>

        </Col>
      </Row>
    </MainLayout>
  );
}

export default RoleIndex;

(function() {
  ReactDOM.render(
    <RoleIndex appData={JSON.parse(appData.value)} />,
    document.getElementById("app")
  );
  document.querySelector("body").removeChild(appData);
})();

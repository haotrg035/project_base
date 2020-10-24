import React from "react";
import ReactDOM from "react-dom";
import MainLayout from "../Layouts/MainLayout";

function UserIndex(props) {
  return <MainLayout {...props.appData}>hi</MainLayout>;
}

(function() {
  ReactDOM.render(
    <UserIndex appData={JSON.parse(appData.value)} />,
    document.getElementById("app")
  );
  document.querySelector("body").removeChild(appData);
})();

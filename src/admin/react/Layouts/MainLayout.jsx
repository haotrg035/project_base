import React, { useContext, useState } from "react";
import {
  Layout,
  Menu,
  Button,
  Skeleton,
  PageHeader,
} from "antd";
import "antd/dist/antd.css";
import {
  DesktopOutlined,
  UserOutlined,
  UsergroupAddOutlined,
  TeamOutlined,
} from "@ant-design/icons";

const { Header, Content, Footer, Sider } = Layout;
const { SubMenu } = Menu;

function MainLayout(props) {
  const [collapse, setCollapse] = useState(false);
  
  const sidebarListItem = [
    {
      //Dashboard item
      route: "/admin/dashboard",
      label: "Dashboard",
      icon: <DesktopOutlined />,
      children: [],
    },
    // [
    //   //Profile item
    //   'route' => 'admin/profile',
    //   'label' => 'Profile',
    //   'iconClass' => 'fas fa-user-circle',
    //   'children' => [],
    // ],
    // [
    //   //Blog item
    //   'route' => 'admin/posts',
    //   'label' => 'Blog',
    //   'iconClass' => 'fas fa-edit',
    //   'children' => [
    //     [
    //       'route' => 'admin/posts',
    //       'label' => lang('App.pages.posts.index'),
    //       'iconClass' => 'far fa-file-alt',
    //     ],
    //     [
    //       'route' => 'admin/posts/categories',
    //       'label' => lang('App.pages.posts.categories'),
    //       'iconClass' => 'fas fa-sitemap',
    //     ],
    //     [
    //       'route' => 'admin/posts/tags',
    //       'label' => lang('App.pages.posts.tags'),
    //       'iconClass' => 'fas fa-tags',
    //     ],
    //   ],
    // ],
    // [
    //   //Contacts item
    //   'route' => 'admin/contacts',
    //   'label' => lang('App.pages.contacts'),
    //   'iconClass' => 'fas fa-envelope',
    //   'children' => [],
    // ],
    // [
    //   //Contacts item
    //   'route' => 'admin/media',
    //   'label' => lang('App.pages.media'),
    //   'iconClass' => 'far fa-images',
    //   'children' => [],
    // ],
    {
      //Contacts item
      route: "/admin/users",
      label: "Người dùng",
      icon: <UserOutlined />,
      children: [
        { route: "/admin/users", label: "Quản lý", icon: <TeamOutlined /> },
        {
          route: "/admin/users/roles",
          label: "Phân quyền",
          icon: <UsergroupAddOutlined />,
        },
      ],
    },
    // [
    //   //Setting item
    //   'route' => 'admin/settings',
    //   'label' => lang('App.pages.setting'),
    //   'iconClass' => 'fas fa-cogs',
    //   'children' => [
    //     [
    //       'route' => 'admin/settings',
    //       'label' => lang('App.pages.general'),
    //       'iconClass' => 'fas fa-cog',
    //     ],
    //     [
    //       'route' => 'admin/settings/email',
    //       'label' => 'email',
    //       'iconClass' => 'far fa-envelope',
    //     ],
    //     [
    //       'route' => 'admin/settings/language',
    //       'label' => lang('App.pages.languages'),
    //       'iconClass' => 'fas fa-globe',
    //     ],
    //   ],
    // ],
  ];
  const onCollapse = (collapsed) => {
    setCollapse(collapsed);
  };

  const renderSiderItems = () => {
    let siderData = sidebarListItem.map((item, key) => {
      if (item.children.length <= 0) {
        return (
          <Menu.Item icon={item.icon} key={key}>
            <a href={item.route}>{item.label}</a>
          </Menu.Item>
        );
      } else {
        return (  
          <SubMenu key={key} icon={item.icon} title={item.label}>
            {item.children.map((child, subkey) => (
              <Menu.Item key={"sub_" + subkey} icon={child.icon}>
                <a href={item.route}>{child.label}</a>
              </Menu.Item>
            ))}
          </SubMenu>
        );
      }
    });
    return siderData;
  };

  return (
    <Layout style={{ minHeight: "100vh" }}>
      <Sider collapsible collapsed={collapse} onCollapse={onCollapse}>
        <div
          className="logo"
          style={{
            height: 32,
            margin: "8px 0",
            display: "flex",
            justifyContent: "center",
            alignItems: "center",
          }}
        >
          <Skeleton.Avatar active={true} />
        </div>
        <Menu theme="dark" defaultSelectedKeys={["1"]} mode="inline">
          {renderSiderItems()}
        </Menu>
      </Sider>
      <Layout className="site-layout">
        <Header style={{ background: "#fff", padding: "0 16px", height: 48 }}></Header>
        <PageHeader
          ghost={false}
          // onBack={() => window.history.back()}
          title={props.meta.title}
          subTitle={props.meta.subtitle}
          extra={props.headerButtons}
        ></PageHeader>

        <Content style={{ margin: "16px" }}>
          <div className="site-layout-background" style={{ minHeight: 360 }}>
            {props.children}
          </div>
        </Content>
        
        <Footer style={{ textAlign: "center" }}>
          Ant Design ©2018 Created by Ant UED
        </Footer>
      </Layout>
    </Layout>
  );
}
export default MainLayout;

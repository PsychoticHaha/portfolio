import MenuTabs from "../../atoms/MenuTabs/MenuTabs";
import LogoutBtn from "../../atoms/LogoutBtn/LogoutBtn";
import TabsContent from "../../atoms/TabsContent/TabsContent";
import { Fragment } from "react/jsx-runtime";

const DashboardLayout = () => {
  return (
    <Fragment>
      <header>
        <div className="left">
          <MenuTabs menuTitle="Messages" className="active" />
          <MenuTabs menuTitle="Reactions" />
          <MenuTabs menuTitle="Usage" />
        </div>
        <LogoutBtn />
      </header>
      <TabsContent />
    </Fragment>
  )
}

export default DashboardLayout
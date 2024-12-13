
const MenuTabs = ({ menuTitle, className }: { menuTitle: string, className?: string }) => {



  return (
    <div className={"item " + className}>{menuTitle}</div>
  )
}

export default MenuTabs
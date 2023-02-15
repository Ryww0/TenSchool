import React from "react";

const NavOfficeItem = ({link, itemTitle}) => {
    const openMenu = () => {

    }

    return (
        <div onClick={() => openMenu()}  className="nav-office-item">
            <a href={link}>{itemTitle}</a>
            <span>{itemTitle}</span>
        </div>
    )
}

export default NavOfficeItem
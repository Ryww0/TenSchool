import React, {Component} from "react";
import NavOfficeSubItem from "./NavOfficeSubItem";

class NavOfficeItem extends Component {
    openMenu() {
        this.props.menuRef.current.classList.toggle("d-none")
        this.props.menuRef.current.classList.toggle("d-block")
    }

    render() {
        return (
            <>
                <div onClick={() => this.openMenu()} className="nav-office-item">
                    <a href={this.props.link}>{this.props.itemTitle}</a>
                    <span>{this.props.itemTitle}</span>
                </div>
            </>
        )
    }
}

export default NavOfficeItem;
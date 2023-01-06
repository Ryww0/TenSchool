import React, {Component} from "react";

class NavOfficeSubItem extends Component {

    render() {
        return (
            <>
                <div className="nav-office-item">
                    <span>{this.props.itemTitle}</span>
                </div>
            </>
        )
    }
}

export default NavOfficeSubItem;
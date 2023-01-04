import React, {Component} from "react";
import {createRoot} from "react-dom/client";

class Profile extends Component {
    state = {
        profileMenu: React.createRef(),
    }

    openProfileMenu() {
        this.state.profileMenu.current.classList.toggle('d-none')
        this.state.profileMenu.current.classList.toggle('d-block')
    }

    render() {
        return (
            <>
                <li onClick={() => this.openProfileMenu()}>Profil</li>
                <ul className="d-none position-absolute top-100 end-0 pe-3" ref={this.state.profileMenu}>
                    <li><a href="./logout">Se déconnecter</a></li>
                </ul>
            </>
        )
    }
}

class ProfileElement extends HTMLElement {
    connectedCallback() {
        const root = createRoot(this)
        root.render(<Profile/>)
    }
}

customElements.define('profile-component', ProfileElement)
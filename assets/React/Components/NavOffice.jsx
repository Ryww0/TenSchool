import React, {createRef} from "react";
import {createRoot} from "react-dom/client";
import {BrowserRouter, Routes, Route} from "react-router-dom";
import NavOfficeItem from "./NavOfficeItem";
import NavOfficeSubItem from "./NavOfficeSubItem";

class NavOffice extends React.Component {
    state = {
        menu1: React.createRef()
    }

    render() {
        return (
            <>
                <NavOfficeItem menuRef={this.state.menu1} itemTitle="Leçons" link="lesson"/>
                <div ref={this.state.menu1} className="nav-office-sub-menu d-none">
                    <NavOfficeSubItem itemTitle="Liste des leçons"/>
                    <hr/>
                    <NavOfficeSubItem itemTitle="ajouter une leçon"/>
                </div>
                <NavOfficeItem itemTitle="Classes"/>
            </>
        )
    }
}

class NavOfficeElement extends HTMLElement {
    connectedCallback() {
        const root = createRoot(this)
        root.render(<NavOffice/>)
    }
}

customElements.define('nav-office-component', NavOfficeElement)
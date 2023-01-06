import React from "react";
import {Link} from "react-router-dom";

function Header() {

    return (
        <>
            <header>
                <nav className="navbar pe-3">
                    <div className="d-flex align-items-center nav-title">
                        <img src="build/images/logo_ten_header.png" alt="logo du site"/>
                        <Link to="/"><span className="title-bicolor-light">ten</span><span
                            className="title-bicolor-dark">school</span></Link>
                    </div>
                    <div>
                        <ul className="d-flex">
                            {/*{% if is_granted('ROLE_ADMIN') %}*/}
                            {/*<li><a href="{{ path('app_back-office') }}">Tableau de bord</a></li>*/}
                            {/*{% endif %}*/}
                            {/*{% if not app.user %}*/}
                            <li><Link className="btn-regular-green" to="/login">se connecter</Link></li>
                            {/*{% else %}*/}
                            {/*<profile-component></profile-component>*/}
                            {/*{% endif %}*/}
                        </ul>
                    </div>
                </nav>
            </header>
        </>
    )
}

export default Header
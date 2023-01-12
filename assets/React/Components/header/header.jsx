import React, {createRef, useEffect, useState} from "react";
import {Link, NavLink} from "react-router-dom";

const API_URL = 'http://localhost:8000/api';

function Header({imgNavbar}) {
    const [subjects, setSubjects] = useState([]);

    useEffect(() => {
        fetch(`${API_URL}/subjects`)
            .then((response) => response.json())
            .then((data) => {

                setSubjects(JSON.parse(data));
            })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    const openNavSubjects = () => {
        navSubjectsContainer.current.classList.toggle('left-nav-subjects')
        navSubjectsCaret.current.classList.toggle('turn-carret-open')
    }

    const navSubjectsContainer = React.useRef();
    const navSubjectsCaret = React.useRef();

    return (
        <>
            <header>
                <nav className="navbar pe-3">
                    <div className="d-flex align-items-center nav-title">
                        <img src={imgNavbar} alt="logo du site"/>
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
                <div ref={navSubjectsContainer} className="nav-subjects-all d-flex">
                    <nav className="nav-subjects d-flex flex-column justify-content-end text-end">
                        <ul>
                            {
                                subjects.map(subject => (
                                    <li className="nav-subjects-link">
                                        <NavLink className="pe-5" to={`subject/${subject.id}`}>{subject.title}</NavLink>
                                    </li>
                                ))
                            }
                        </ul>
                    </nav>
                    <div className="d-flex align-items-center">
                        <div onClick={openNavSubjects}
                             className="btn-nav-subjects d-flex justify-content-center align-items-center">
                            <img ref={navSubjectsCaret} id="nav-subjects-caret-right"
                                 src="build/images/caret-right-dark.png" alt=""/>
                        </div>
                    </div>
                </div>
            </header>
        </>
    )
}

export default Header
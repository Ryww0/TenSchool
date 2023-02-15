import React, { useEffect, useState} from "react";
import {Link, NavLink} from "react-router-dom";

const API_URL = 'http://127.0.0.1:8000/api';

function Header({imgNavbar}) {
    const [subjects, setSubjects] = useState([]);
    const [isLoggedIn, setIsLoggedIn] = useState(false);
    const [isAdmin, setIsAdmin] = useState(false);
    const [user, setUser] = useState([]);

    // fetch to return all the subjects
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

    // fetch to return a bool if user is admin or not
    useEffect(() => {
        fetch(`${API_URL}/check-admin`)
            .then(response => response.json())
            .then(data => {
                setIsAdmin(data);
            });
    }, []);

    // fetch to return a bool if user is connected or not
    useEffect(() => {
        fetch(`${API_URL}/check-login`)
            .then(response => response.json())
            .then(data => {
                setIsLoggedIn(data);
            });
    }, []);

    // fetch user connected
    useEffect(() => {
        fetch(`${API_URL}/users/${id}`)
            .then(response => response.json())
            .then(data => {
                setUser(JSON.parse(data));
            });
    }, []);

    const openNavSubjects = () => {
        navSubjectsContainer.current.classList.toggle('left-nav-subjects');
        navSubjectsCaret.current.classList.toggle('turn-carret-open');
    }

    const openProfileMenu = () => {
        profileMenu.current.classList.toggle('d-none');
        profileMenu.current.classList.toggle('active');
    }

    const closeProfileMenu = () => {
        profileMenu.current.classList.add('d-none');
        profileMenu.current.classList.remove('active');
    }

    const navSubjectsContainer = React.useRef();
    const navSubjectsCaret = React.useRef();
    const profileMenu = React.useRef();

    const id = userID;

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
                            {
                                isLoggedIn ? (
                                    <>
                                        <li className="profil-dropdown-button"
                                            onClick={() => openProfileMenu()}>Profil
                                        </li>
                                        <ul className="profil-dropdown-menu d-none position-absolute pe-3"
                                            ref={profileMenu}>
                                            <li><Link onClick={() => closeProfileMenu()} to={`profile/${id}`}>Mon profil</Link></li>
                                            <hr/>
                                            {
                                                isAdmin.isAdmin ? (
                                                    <>
                                                        <li><a onClick={() => closeProfileMenu()} href="/admin/dashboard">Tableau de bord</a></li>
                                                        <hr/>
                                                    </>
                                                ) : (
                                                    <>
                                                        <li><Link onClick={() => closeProfileMenu()} to={`classroom/${user.classroom?.id}`}>Ma classe</Link></li>
                                                        <hr/>
                                                        <li><Link onClick={() => closeProfileMenu()} to={`tests`}>Mes évaluations</Link></li>
                                                        <hr/>
                                                    </>
                                                )
                                            }
                                            <li><a href="/logout">Se déconnecter</a></li>
                                        </ul>
                                    </>
                                ) : (
                                    <li><a className="btn-regular-green" href="/login">se connecter</a></li>
                                )
                            }
                        </ul>
                    </div>
                </nav>
                <div ref={navSubjectsContainer} className="nav-subjects-all d-flex">
                    <nav className="nav-subjects d-flex flex-column justify-content-end text-end">
                        <ul>
                            {
                                subjects?.map(subject => (
                                    <li key={subject.id} className="nav-subjects-link">
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
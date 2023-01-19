import React, {Component, Fragment, useEffect, useState} from "react";
import {useParams} from "react-router-dom";

const API_URL = 'http://127.0.0.1:8000/api';

const Profile = () => {
    const [user, setUSer] = useState([]);
    const [isAdmin, setIsAdmin] = useState(false);

    // user infos
    useEffect(() => {
        fetch(`${API_URL}/users/${id}`)
            .then((response) => response.json())
            .then((data) => {
                setUSer(JSON.parse(data));
            })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    // admin check
    useEffect(() => {
        fetch(`${API_URL}/check-admin`)
            .then(response => response.json())
            .then(data => {
                setIsAdmin(data);
            });
    }, []);

    console.log(user.classroom)

    const id = userID;

    return (
        <div className="profile-page container pt-5">
            <h1>Profil</h1>
            <div className="profile-container d-flex mt-3">
                <div className="profile-image-container"></div>
                <div className="profile-infos-container d-flex">
                    <div className="profile-infos-content d-flex flex-column justify-content-end me-5 ms-5">
                        <h3>
                            <span className="text-uppercase">{user.lastname}</span> <span
                            className="text-capitalize">{user.firstname}</span>
                        </h3>
                        {
                            isAdmin ? (
                                <ul>
                                    {
                                        user.classrooms.map(c => (
                                            <li>{c.name}</li>
                                        ))
                                    }
                                </ul>
                            ) : (
                                <h4>{user.classroom?.name}</h4>
                            )
                        }
                    </div>
                    <div className="profile-infos-edit-container d-flex align-items-end">
                        <a href="" className="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 className="bi bi-brush-fill" viewBox="0 0 16 16">
                                <path
                                    d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.118 8.118 0 0 1-3.078.132 3.659 3.659 0 0 1-.562-.135 1.382 1.382 0 0 1-.466-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Profile;
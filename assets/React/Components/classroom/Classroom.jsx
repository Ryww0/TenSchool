import React, {useEffect, useState} from "react";
import {useParams} from "react-router-dom";

const Classroom = () => {
    const [user, setUser] = useState([]);

    const API_URL = 'http://127.0.0.1:8000/api';

    // fetch user connected and classroom infos
    useEffect(() => {
        fetch(`${API_URL}/users/${id}`)
            .then(response => response.json())
            .then(data => {
                setUser(JSON.parse(data))
            })
    }, []);

    const id = userID;

    return (
        <div className="classroom-page container pt-5">
            <h1>Classe</h1>
            <div className="d-flex justify-content-between">
                <h3>{user.classroom?.name}</h3>
                <h5><span className="text-uppercase">{user.classroom?.user.lastname}</span> <span
                    className="text-capitalize">{user.classroom?.user.firstname}</span></h5>
            </div>
            <div className="row pt-5">
                <div className="col-md-5">
                    <h4>Tous les élèves</h4>
                    <ul className="d-flex flex-wrap">
                        {
                            user.classroom?.users.map(user => (
                                <li key={user}>{user}</li>
                            ))
                        }
                    </ul>
                </div>
                <div className="col-md-7">
                    <h4>Tous les cours</h4>
                    <ul className="d-flex flex-wrap">
                        {
                            user.classroom?.lessons.map(lesson => (
                                    <li className="m-2" key={lesson.id}>{lesson.title}</li>
                            ))
                        }
                    </ul>
                </div>
            </div>
        </div>
    )
}

export default Classroom
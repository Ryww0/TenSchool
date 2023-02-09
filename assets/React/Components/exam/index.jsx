import React, {useEffect, useState} from "react";
import {Link} from "react-router-dom";

const Tests = () => {
    const [tests, setTests] = useState([]);

    const API_URL = 'http://127.0.0.1:8000/api';
    const id = userID;

    const current = new Date().getTime();

    useEffect(() => {
        fetch(`${API_URL}/tests/${id}`)
            .then(response => response.json())
            .then(data => {
                setTests(JSON.parse(data))
            })
    }, []);

    return (
        <div className="container tests-page pt-5 pb-5">
            <h1>Mes évaluations</h1>
            <div className="row">
                {
                    tests.map(test => (
                        (current) < (Date.parse(test.startDate)) + test.duration * 60 ? (
                            <div key={test.id}
                                 className="card-new-test col-12 d-flex justify-content-between align-items-center">
                                <div>
                                    <span className="lil">nouvelle évaluation</span>
                                    <h4>{test.title}</h4>
                                </div>
                                {
                                    test.available ? (
                                        <div>
                                            <Link to={`/test/${test.id}`}>c'est parti !</Link>
                                        </div>
                                    ) : (
                                        <div>
                                            <span>disponible le </span>
                                            <span>{test.startDate}</span>
                                        </div>
                                    )
                                }
                            </div>
                        ) : (
                            <div key={test.id} className="card-test col-12 col-md-3 ps-3 d-flex align-items-center m-1">
                                <h4>{test.title}</h4>
                                <div>
                                    <a href="">voir la correction</a>
                                </div>
                            </div>
                        )
                    ))
                }
            </div>
        </div>
    )
}

export default Tests
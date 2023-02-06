import React, {Fragment, useEffect, useState} from "react";
import {useNavigate, useParams} from "react-router-dom";
import login from "../login/Login";

const API_URL = 'http://localhost:8000/api'

const Test = () => {
    let navigate = useNavigate();
    const {testID} = useParams();
    const [test, setTest] = useState([]);
    const [formData, setFormData] = useState([])

    const handleChange = (event) => {
        setFormData({ ...formData, [event.target.name]: event.target.value });
    };

    useEffect(() => {
        fetch(`${API_URL}/test/${testID}`)
            .then((response) => response.json())
            .then((data) => {
                setTest(JSON.parse(data));
            })
            .catch((error) => {
                console.log(error);
            });
    }, [testID])

    let i = 0

    const incrementI = () => {
        i++
    }

    const handleSubmit = (event) => {
        event.preventDefault();
        fetch("http://127.0.0.1:8000/api/test/7/render/new", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Success:", data);
                console.log(JSON.stringify(formData))
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    return (
        <div className="container test-page d-flex align-items-center">
            <div>
                <h2>Évaluation</h2>
                <h1>{test.title}</h1>
                <form method="post" onSubmit={handleSubmit} action="http://127.0.0.1:8000/api/test/7/render/new">
                    {
                        test.questions?.map(question => (
                            <div key={question.id} className="d-flex flex-column">
                                {incrementI()}
                                <label htmlFor={question.id}>Question {i}: {question.content}</label>
                                <input name={question.id} type="text" onChange={handleChange}/>
                            </div>
                        ))
                    }
                    <input type="submit"/>
                </form>
            </div>
        </div>
    )
}

export default Test;
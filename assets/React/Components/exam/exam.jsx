import React, { useEffect, useRef, useState} from "react";
import {useNavigate, useParams} from "react-router-dom";
import login from "../login/Login";

const API_URL = 'http://localhost:8000/api'

const Test = () => {
    let navigate = useNavigate();
    const {testID} = useParams();
    const [test, setTest] = useState([]);
    const [formData, setFormData] = useState([])
    const [i, setI] = useState(1);
    const [j, setJ] = useState(0);

    const area = useRef();

    const handleChange = (event) => {
        setFormData({...formData, [event.target.name]: event.target.value});
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

    const handleSubmit = (event) => {
        // event.preventDefault();
        fetch("http://127.0.0.1:8000/api/test/7/render/new", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(formData),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Success:", data);
                navigate('/tests');
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    const resetArea = () => {
        area.current.value = "";
    }

    return (
        <div className="container test-page">
            <div>
                <div>
                <h2>Évaluation</h2>
                <h1>{test.title}</h1>
                </div>
                <div className="d-flex flex-column align-items-end test-page-content"
                >
                    <h4>Question {i}</h4>
                    <label htmlFor={i}>{test.questions?.[j].content}</label>
                    <textarea ref={area} onChange={handleChange} name={i}></textarea>
                    {
                        i < test.questions?.length ? (
                            <button className="button-test" onClick={() => {
                                setI(i + 1);
                                setJ(j + 1);
                                resetArea();
                            }}>Suivant
                            </button>
                        ) : (
                            <button className="button-test" onClick={() => {
                                handleSubmit()
                            }}>Envoyer
                            </button>
                        )
                    }
                </div>
            </div>
        </div>
    )
}

export default Test;
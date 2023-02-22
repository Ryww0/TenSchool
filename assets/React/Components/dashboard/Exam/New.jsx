import React, {useEffect, useRef, useState} from "react";
import {useNavigate, useParams} from 'react-router-dom';

const API_URL = 'http://127.0.0.1:8000/api/back';

const New = () => {
    const [formDataTest, setFormDataTest] = useState([]);
    const [formDataQuestion, setFormDataQuestion] = useState([]);
    const [i, setI] = useState(0);
    const [classrooms, setClassrooms] = useState([]);
    const questionInput = useRef();
    const navigate = useNavigate();

    const handleChange = (event) => {
        setFormDataTest({...formDataTest, [event.target.name]: event.target.value});
    };

    const handleChangeQuestion = (event) => {
        setFormDataQuestion({...formDataQuestion, [event.target.name]: event.target.value});
    };

    const handleSubmit = (e) => {
        fetch("http://127.0.0.1:8000/api/back/test/new", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify([formDataTest, formDataQuestion])
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Success:", data);
                navigate('/admin/dashboard/tests    ');
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    const changeQuestion = (e) => {
        e.preventDefault();
        setI(i + 1);
        questionInput.current.value = "";
    }

    return (
        <main className="office">

            <div className="d-flex flex-column create-form" onSubmit={() => handleSubmit()} action="/api/back/test/new" method="POST">
                {/*<label htmlFor="title">Titre</label>*/}
                <input onChange={handleChange} type="text" name="title" placeholder="insérer un titre"/>

                {/*<label htmlFor="duration">Durée (en min)</label>*/}
                <input onChange={handleChange} type="number" name="duration" placeholder="durée (en min)"/>

                <div className='d-flex'>
                    <input ref={questionInput} onChange={handleChangeQuestion} className="m-1" type="text"
                           name={i}
                           placeholder="Question"/>
                    <button onClick={changeQuestion}>Add question</button>
                </div>
                {/*<input type="submit"/>*/}
                <button onClick={() => handleSubmit()}>Envoyer</button>
            </div>
        </main>
    )
}

export default New
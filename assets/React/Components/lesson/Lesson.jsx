import React, {useEffect, useState} from "react";
import {useParams} from "react-router-dom";
import Header from "../header/header";

const API_URL = 'http://localhost:8000/api';

const Lesson = () => {
    const {lessonId} = useParams();
    const [lesson, setLesson] = useState([]);

    useEffect(() => {
        fetch(`${API_URL}/lesson/${lessonId}`)
            .then((response) => response.json())
            .then((data) => {
                setLesson(JSON.parse(data));
            })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    return (
        <>
            <div className="container">
                <h1>{lesson.title}</h1>
                <p>
                    {lesson.content}
                </p>
            </div>
        </>
    )
}

export default Lesson
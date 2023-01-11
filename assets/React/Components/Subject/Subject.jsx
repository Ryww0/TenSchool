import React, {useEffect, useState} from "react";
import {useParams} from "react-router-dom";
import CardLesson from '../cards/CardLesson'

const API_URL = 'http://localhost:8000/api';

const Subject = () => {
    const {subjectId} = useParams();
    const [lessons, setLessons] = useState([]);

    useEffect(() => {
        fetch(`${API_URL}/subject/${subjectId}/lessons`)
            .then((response) => response.json())
            .then((data) => {
                setLessons(JSON.parse(data));
            })
            .catch((error) => {
                console.log(error);
            });
    }, [subjectId]);

    console.log(lessons)

    return (
        <>
            <div className="container mb-5">
                <ul>
                    {
                        lessons.map(lesson => (
                            <CardLesson lesson={lesson}/>
                        ))
                    }
                </ul>
            </div>
        </>
    )
}

export default Subject;
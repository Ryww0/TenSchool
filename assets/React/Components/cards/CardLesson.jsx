import React from "react";

const CardLesson = ({lesson}) => {
    return (
        <>
            <div className="card-lesson p-3 mt-3">
                <div className="d-flex justify-content-between">
                    <div>
                        <h4>{lesson.title}</h4>
                        <h5>{lesson.subject.title}</h5>
                    </div>
                    <div>
                        <span className="date-created">créé le {lesson.dateCreated}</span>
                    </div>
                </div>
                <div className="mt-4">
                    <p>{lesson.description}</p>
                </div>
                <div className="d-flex justify-content-center mt-4">
                    <img src="build/images/caret-down-dark.png" alt=""/>
                </div>
            </div>
        </>
    )
}

export default CardLesson;
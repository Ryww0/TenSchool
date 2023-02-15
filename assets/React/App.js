import React, {useState, useEffect} from 'react';
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";

import Home from "./Components/home/Home";
import Footer from "./Components/footer/footer";
import Subject from "./Components/Subject/Subject";
import Lesson from "./Components/lesson/Lesson";
import ErrorPage from "./Components/404/ErrorPage";
import Dashboard from "./Components/dashboard/Dashboard";
import Header from "./Components/header/header";
import Profil from "./Components/Profil";
import Classroom from "./Components/classroom/Classroom";
import Tests from "./Components/exam";
import Test from "./Components/exam/exam";
import HeaderOffice from "./Components/dashboard/HeaderOffice";

const imgNavbar = `build/images/logo_ten_header.png`;

function App() {

    return (
        <>
            <Router>
                {
                    window.location.pathname.indexOf('admin') > -1 ? (
                        <HeaderOffice/>
                    ) : (
                        <Header imgNavbar={imgNavbar}/>
                    )
                }
                <Routes>
                    <Route path="/" element={<Home/>}/>
                    <Route path="subject/:subjectId" element={<Subject/>}/>
                    <Route path="lesson/:lessonId" element={<Lesson/>}/>
                    <Route path="profile/:profileId" element={<Profil/>}/>
                    <Route path="classroom/:classroomId" element={<Classroom/>}/>
                    <Route path="/tests" element={<Tests/>}/>
                    <Route path="/test/:testID" element={<Test/>}/>


                    <Route path="/admin/dashboard" element={<Dashboard/>}/>

                    <Route path="*" element={<ErrorPage/>}/>
                </Routes>
                <Footer/>
            </Router>
        </>
    )
        ;
}

export default App;
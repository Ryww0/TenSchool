import React, {useState, useEffect} from 'react';
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Header from "./Components/header/header";
import Home from "./Components/home/Home";
import Footer from "./Components/footer/footer";
import Subject from "./Components/Subject/Subject";
import Lesson from "./Components/lesson/Lesson";

const API_URL = 'http://localhost:8000/api';

const imgNavbar = './build/images/logo_ten_header.png'

function App() {

    return (
        <>
            <Router>
                <Header imgNavbar={imgNavbar}/>
                <Routes>
                    <Route path="/" element={<Home/>}/>
                    <Route path="/subject/:subjectId" element={<Subject/>}/>
                    <Route path="/lesson/:lessonId" element={<Lesson/>}/>
                    {/*<Route path="/login" element={<Login/>}/>*/}
                </Routes>
                <Footer/>
            </Router>
        </>
    );
}

export default App;
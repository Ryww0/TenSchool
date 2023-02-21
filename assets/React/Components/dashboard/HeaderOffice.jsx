import React from "react";
import NavOfficeItem from "./NavOfficeItem";
import NavOfficeSubItem from "../NavOfficeSubItem";
import {Link, NavLink} from "react-router-dom";

const HeaderOffice = () => {
    const menu1 = React.createRef();

    return (
        <nav className="nav-office">
            <div className="d-flex align-items-center justify-content-start">
                <img src="/build/images/logo_ten_header.png" alt="logo site"/>
                <Link to="/admin/dashboard">tenschool</Link>
            </div>
            <div className='mt-5'>
                <ul className='office-menu d-flex flex-column'>
                    <li className='d-flex align-items-center'>
                        <svg className='office-icon m-1' viewBox="0 0 282 225" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M131.888 10.6337C136.677 5.04473 145.323 5.04474 150.112 10.6337L246.136 122.692C252.806 130.476 247.275 142.5 237.024 142.5H44.9764C34.725 142.5 29.1938 130.476 35.8643 122.692L131.888 10.6337Z"
                                fill="#68BC8D"/>
                            <path fillRule="evenodd" clipRule="evenodd"
                                  d="M59 128C52.3726 128 47 133.373 47 140V213C47 219.627 52.3726 225 59 225H104V213.5C104 193.342 120.342 177 140.5 177C160.658 177 177 193.342 177 213.5V225H223C229.627 225 235 219.627 235 213V140C235 133.373 229.627 128 223 128H59Z"
                                  fill="#68BC8D"/>
                        </svg>
                        <a href="/">Back to home</a>
                    </li>
                    <li className='d-flex align-items-center'>
                        <NavLink to="/admin/dashboard/tests">
                            <svg className='office-icon m-1' viewBox="0 0 238 224" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fillRule="evenodd" clipRule="evenodd"
                                      d="M11.4123 223.32H42.8349H82.7457C89.3731 223.32 94.9006 217.863 93.2543 211.444C88.5213 192.988 73.0152 178.85 53.8349 176.129L53.8349 11C53.8349 4.92487 48.9101 0 42.8349 0C36.7598 0 31.8349 4.92486 31.8349 11L31.8349 178.143C16.6667 183.26 4.91538 195.801 0.903723 211.444C-0.7426 217.863 4.7849 223.32 11.4123 223.32ZM64 41V81.9625C64 117.504 82.077 131.626 112.753 113.678C120.186 109.329 128.361 107.681 138 112.5C151.075 119.037 162.814 115.341 175.81 111.248C189.36 106.981 204.277 102.284 223.498 108.31C232.419 111.107 242.173 103.192 235.894 96.2638C226.052 85.404 213.235 84.5333 199.815 83.6217C181.685 82.3903 162.456 81.0841 147.979 54.9727C135.222 31.9631 118.431 18.5845 103.219 10.8057C83.0578 0.49658 64 18.3563 64 41Z"
                                      fill="#68BC8D"/>
                            </svg>
                            Évaluation</NavLink>
                    </li>
                    <li className='d-flex align-items-center'>
                        <NavLink to="/admin/dashboard/users">
                            <svg className='office-icon m-1' viewBox="0 0 149 180" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fillRule="evenodd" clipRule="evenodd"
                                      d="M74.5 90.4036C97.774 90.4036 116.641 70.1661 116.641 45.2018C116.641 20.2375 97.774 0 74.5 0C51.2259 0 32.3586 20.2375 32.3586 45.2018C32.3586 70.1661 51.2259 90.4036 74.5 90.4036ZM149 179.596C149 179.731 149 179.866 148.999 180H0.0011131C0.00037135 179.866 0 179.731 0 179.596C0 139.252 33.3548 106.547 74.5 106.547C115.645 106.547 149 139.252 149 179.596Z"
                                      fill="#68BC8D"/>
                            </svg>
                            Élève
                        </NavLink>
                    </li>
                </ul>
            </div>
        </nav>
    )
}

export default HeaderOffice;
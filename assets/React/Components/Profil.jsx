import React, {Component} from "react";

const Profile = () => {
    const id = userID;

    return (
        <>
            <h1>Profil</h1>
            <div className="profile-container">
                <div className="profile-image-container"></div>
                <div className="profile-infos-container">
                    <div className="profile-infos-content">
                        <h3>
                            <span className="text-uppercase">lastname</span> <span
                            className="text-capitalize">firstname</span>
                        </h3>
                        <h4>classe</h4>
                    </div>
                    <div className="profile-infos-edit-container">
                        <p>edit</p>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Profile;
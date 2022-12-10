import React, { useState } from "react";
import axios from "axios";

const Magasins = () => {
    const [nom, setNom] = useState("");
    const [nb, setNb] = useState();
    const URL = "http://localhost:3005/magasins"
    const handleSubmit = () => {
        axios.post(URL, {
            name: nom,
            nbEmployes: nb,
        });
        window.alert("Magasin Ajouté avec succès")
    }
    return (
        <div className="form">
            <h2>Ajouter un magasin</h2>
            <form onSubmit={(e) => handleSubmit(e)}>
                <input
                    type="text"
                    placeholder="Nom du Magasin"
                    value={nom}
                    onChange={(e) => setNom(e.target.value)}
                >
                </input>
                <input
                    type="number"
                    placeholder="Nombre d'employés"
                    value={nb}
                    onChange={(e) => setNb(e.target.value)}
                >
                </input>

                <input type="submit" value="Ajouter" />

            </form>
        </div>
    )
}

export default Magasins;
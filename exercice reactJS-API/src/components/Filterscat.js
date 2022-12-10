import React, { useState, useEffect } from "react";
import axios from "axios";
import Produits from "./Produits";

const Filterscat = () => {
    const [list, setList] = useState([]);
    const [cat, setCat] = useState("");
    const categories = [
        { label: "Ordinateurs", value : "Ordinateurs"},
        { label: "Cellulaires", value : "Cellulaires"},
        { label: "Téléviseurs", value : "Téléviseurs"}
    ]

    useEffect(() => {
        axios.get(`http://localhost:3005/produits?categorie=${cat}`).then((res) => setList(res.data));
    }, [cat]);

    const onChangeValue = (e) => {
        setCat(e.target.value);
    }


    return(
        <div className="filters">
            <div className="sort-container" onChange={onChangeValue} >
            {categories.map(radio => (
                    <div className="radio" key={radio.value}>
                        <input 
                           type="radio"
                           value={radio.value}
                           checked={radio.value == cat}
                           onChange={(e) => setCat(e.target.value)}
                        />
                        <label>{radio.label}</label>
                    </div>
                ))}

            </div>
            <div className="cancel">
                {cat && (<h5 onClick={() =>
                    setCat("")}>Annuler le filtre</h5>)}
            </div>

            
            {cat ? (
                <ul>
                    {list
                        .map((d) => (
                            <Produits liste={d} key={d.id} />
                        ))}
                </ul>
            ) : (
                <h1>Choisissez une catégorie</h1>
            )}
        </div>
    )
}


export default Filterscat;
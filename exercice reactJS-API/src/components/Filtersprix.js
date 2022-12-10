import React, { useState, useEffect } from "react";
import axios from "axios";
import Produits from "./Produits";

const Filtersprix = () => {
    const [list, setList] = useState("");
    const [order, setOrder] = useState("")



    useEffect(() => {
        axios.get(`http://localhost:3005/produits?_sort=prix&_order=${order}`).then((res) => setList(res.data));
    }, [order]);

    const onChangeValue = (e) => {
        setOrder(e.target.value);
    }

    return (
        <div className="filters">
            <div className="sort-container" onChange={onChangeValue}>
                <input type="radio" value="asc" name="filter" />Prix Croissant
                <input type="radio" value="desc" name="filter" />Prix Desendant
            </div>
            <div className="cancel">
                {order && (<h5 onClick={() =>
                    setOrder("")}>Annuler le filtre</h5>)}
            </div>


            {order ? (
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

export default Filtersprix;
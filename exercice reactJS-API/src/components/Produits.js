import React from "react";

const Produits = ({ liste }) => {
    return (
        <div className="produits">
            <p><b>Nom:</b> {liste.nom}</p>
            <p><b>Prix:</b> {liste.prix}</p>
            <p><b>Disponibilité:</b> {liste.disponibilite}</p>
            <p><b>Expédition:</b> {liste.expedition}</p>
            
        </div>
    )
}

export default Produits;
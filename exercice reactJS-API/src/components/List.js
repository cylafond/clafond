import React, {useState, useEffect} from "react";
import axios from "axios";
import Produits from "./Produits";


const List = () => {
    const [list, setList] = useState([]);
    const URL = 'http://localhost:3005/produits'
    useEffect(() => {
        axios.get(URL).then((res) => setList(res.data))
    }, [])
    

    return (
        <div className="list">
            {list
            .map((d) => (
            <Produits liste={d} key={d.id}/>
            ))}
        </div>
    )
}

export default List;
import { Container } from "@mui/material"
import axios from "axios"
import { useState, useEffect } from 'react'
import socketIOClient from "socket.io-client";
const ENDPOINT = "http://127.0.0.1:8000";

function ExampleSocketIO() {

    let [users, setUsers] = useState([])

    useEffect(() => {
        const socket = socketIOClient(ENDPOINT);
        socket.on("server.created", data => {
          console.log(`data`, data)
        });
      }, [])

    return (
        <Container>
            <ul>
                {
                    users.map((user, index) => <li key={index}>{user.email}</li>)
                }
            </ul>
        </Container>
    );
}

export default ExampleSocketIO;

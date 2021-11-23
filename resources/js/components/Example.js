import { Container } from "@mui/material"
import { useState, useEffect } from 'react'
import BasicTable from './BasicTable'

function Example() {

    const [users, setUsers] = useState([])

    useEffect(() => {
        loadUsers();
    }, [])

    async function loadUsers() {
        try {
            const { data } = await axios.get('api/user')

            setUsers(data.users)

            window.Echo.channel('test')
            .listen('.server.created', (event) => {

                setUsers(prevUsers => {
                    return [...prevUsers,event.message]
                })
            });

        } catch (error) {
            console.log(error);
        }
    }

    // function createData(name, Email, created_at) {
    //     return { name, Email, created_at };
    // }

    // const rows = [
    //     createData('Name', 'Email', 'created_at'),
    // ];

    return (
        <Container>
            <BasicTable users={users} />
        </Container>
    );
}

export default Example;

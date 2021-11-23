<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>

    <body class="antialiased">
        <div id="app"></div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>

{{--
    <script>
        console.log("jquery here")

        let ress = [];
            // async function loadUsers() {
                // try {
                    axios.get('api/user').then((res)=>{

                        ress.push(res);
                    }).catch((err)=>{console.log(`err`, err)})

console.log(`res`, ress)

                    // setUsers(data.users);
                // } catch (error) {
                //     console.log(error);
                // }
            // }

            // loadUsers()
        //    const { data } = res

// console.log(`data`, ress)

            // window.Echo.channel('test')
            //     .listen('.server.created', (event) => {

            //         data.push()
            //         console.log(`event`, event)
            //         addUser(event.message);
            //     });


    </script> --}}
</html>

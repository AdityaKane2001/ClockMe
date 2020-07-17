<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProTimerPage</title>
    <meta name="description" content="Add a dark-mode theme toggle with a Bootstrap Custom Switch">

    <meta property="og:site_name" content="GitHub">
    <meta property="og:image"
        content="https://repository-images.githubusercontent.com/194995309/38db8f80-9db7-11e9-998f-43f2a26d9e0b">
    <meta property="og:title" content="dark-mode-switch">
    <meta property="og:description" content="Add a dark-mode theme toggle with a Bootstrap Custom Switch">
    <meta property="og:url" content="https://coliff.github.io/dark-mode-switch/">
    <link rel="author" href="https://christianoliff.com/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="dark-mode.css">
</head>

<body class="bg-white text-center d-flex h-100">
    <div class="container d-flex p-3 mx-auto flex-column ">
        <header class="mb-auto ">
            <h3 class="float-left" style="color:#eb6b21"><b>Cbusie</b></h3>
            <nav class="nav justify-content-center float-right ">
                <a class="nav-link active" style="color:#eb6b21" href="#">Todos App</a>
                <a class="nav-link" style="color:#eb6b21" href="protimerpage.html">ProTimer</a>

                <div class="nav-link">

                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="darkSwitch">
                        <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">Dark Mode</label>
                    </div>

                    <script src="dark-mode-switch.min.js"></script>

                </div>
            </nav>
        </header>

        <div class="container ">
            <div class="row mt-5 ">
                <div class="col-md-8 offset-md-2">

                    <div class="card">
                        <div class="card-header shadow-sm bg-white">
                            <h1 style="color:#eb6b21">ProTimer</h1>
                            <button data-toggle="modal" data-target="#exampleModal" class="btn"
                                style="border-radius: 50%;background-color:#eb6b21;font-size: 20px;"><b>+</b></button>

                        </div>
                        <div class="card-body bg-white">
                            <ul class="list-group bg-white">

                                <li class="list-group-item bg-light">


                                    <button class="float-right ml-1"
                                        style="background-color:#eb6b21;border-radius:50px;height: 30px;width:100px;">
                                       <b><p id="output">0:00:00</p></b>
                                    </button>

                                    <div class="controls">

                                        <button class="float-right ml-1"
                                            style="background-color:#eb6b21;border-radius:50px;height: 30px;width:80px;"  onclick='startPause()' id="startPause">
                                            <b id="start">Start</b>
                                        </button>


                                    </div>
                                    <!-- hidden inputs -->
                                    <input type="text" class="float-right ml-1" id="start_time">
                                    <input type="text" class="float-right ml-1" id="end_time">
                                    <input type="text" class="float-right ml-1" id="project_name">

                                </li>

                                <li class="list-group-item bg-light">


                                    <button class="float-right ml-1"
                                        style="background-color:#eb6b21;border-radius:50px;height: 30px;width:100px;">
                                       <b><p id="output1">0:00:00</p></b>
                                    </button>

                                    <div class="controls">

                                        <button class="float-right ml-1"
                                            style="background-color:#eb6b21;border-radius:50px;height: 30px;width:80px;"  onclick='startPause1()' id="startPause1">
                                            <b id="start1">Start</b>
                                        </button>


                                    </div>
                                    <!-- hidden inputs -->
                                    <input type="text" class="float-right ml-1" id="start_time1">
                                    <input type="text" class="float-right ml-1" id="end_time1">
                                    <input type="text" class="float-right ml-1" id="project_name1">

                                </li>

                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h5 class="modal-title bg-white" id="exampleModalLabel" style="color:#eb6b21 ;"><b>Add
                                Project</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #eb6b21;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-white">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Project Name" name='project'>
                        </div>
                    </div>
                    <div class="modal-footer bg-white">
                        <button type="button" style="background-color: #eb6b21;border-radius: 50px;"
                            data-dismiss="modal"><b>Close</b></button>
                        <button type="button" style="background-color: #eb6b21;border-radius: 50px"><b>Add</b></button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="mt-auto">
            <p>Made with &#9825; by Aditya Kane and Tanvesh Chavan </p>
        </footer>

    </div>

</body>

<script src="stopwatch3.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

</html>

<?php
include('navbar.php')
?>
<!doctype html>
<html>
    <style>
        .progress {
            background: #f2f4f8 none repeat scroll 0 0;
            border-radius: 0;
            height: 30px;
        }
    </style>
    <body>
        <div class="container">
            <div>
                <div class="table-wrap justify-content-left">
                    <div class="col-md-3">

                                <tr>
                                    <th><h1>4.1</h1></th>
                                </tr>

                    </div>
                    <div class="col-md-9">
                        <table class="table table-borderless col-md-9">
                            <tbody>

                                <tr>
                                    <th class="col-md-2">Bintang 5</th>
                                    <th>
                                        <div class="progress">
                                            <div style="width: 56%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Bintang 4</th>
                                </tr>
                                <tr>
                                    <th>Bintang 3</th>
                                </tr>
                                <tr>
                                    <th>Bintang 2</th>
                                </tr>
                                <tr>
                                    <th>Bintang 1</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
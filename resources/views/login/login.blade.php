<!doctype html>
<html>
<head lang="en">
    <!-- Mirrored from preview.colorlib.com/theme/bootstrap/login-form-07/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Nov 2023 14:01:05 GMT -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <link href="{{ asset('assets/img/daphne.jpeg') }}" rel="icon">
    <title>Daphne Lord school</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loginCss/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/loginCss/style.css') }}">
    <title>Login #7</title>
    <script nonce="f7f7b0c9-8fd9-425c-b8d5-c3a6f8a46bc7">
        (function (w, d) {
            ! function (j, k, l, m) {
                j[l] = j[l] || {};
                j[l].executed = [];
                j.zaraz = {
                    deferred: [],
                    listeners: []
                };
                j.zaraz.q = [];
                j.zaraz._f = function (n) {
                    return async function () {
                        var o = Array.prototype.slice.call(arguments);
                        j.zaraz.q.push({
                            m: n,
                            a: o
                        })
                    }
                };
                for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                j.zaraz.init = () => {
                    var q = k.getElementsByTagName(m)[0],
                        r = k.createElement(m),
                        s = k.getElementsByTagName("title")[0];
                    s && (j[l].t = k.getElementsByTagName("title")[0].text);
                    j[l].x = Math.random();
                    j[l].w = j.screen.width;
                    j[l].h = j.screen.height;
                    j[l].j = j.innerHeight;
                    j[l].e = j.innerWidth;
                    j[l].l = j.location.href;
                    j[l].r = k.referrer;
                    j[l].k = j.screen.colorDepth;
                    j[l].n = k.characterSet;
                    j[l].o = (new Date).getTimezoneOffset();
                    if (j.dataLayer)
                        for (const w of Object.entries(Object.entries(dataLayer).reduce(((x, y) => ({
                                ...x[1],
                                ...y[1]
                            })), {}))) zaraz.set(w[0], w[1], {
                            scope: "page"
                        });
                    j[l].q = [];
                    for (; j.zaraz.q.length;) {
                        const z = j.zaraz.q.shift();
                        j[l].q.push(z)
                    }
                    r.defer = !0;
                    for (const A of [localStorage, sessionStorage]) Object.keys(A || {}).filter((C => C
                        .startsWith("_zaraz_"))).forEach((B => {
                        try {
                            j[l]["z_" + B.slice(7)] = JSON.parse(A.getItem(B))
                        } catch {
                            j[l]["z_" + B.slice(7)] = A.getItem(B)
                        }
                    }));
                    r.referrerPolicy = "origin";
                    r.src = "https://preview.colorlib.com/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON
                        .stringify(j[l])));
                    q.parentNode.insertBefore(r, q)
                };
                ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">


<!-- ... Your existing code ... -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#log").click(function (e) {
        e.preventDefault();
        var buttonValue = $(this).val();

        var username = $("#username").val();
        var password = $("#password").val();

        if (username === '' || password === '') {
            alert('Please enter both username and password.');
            return;
        }

        var dataToSend = {
            buttonValue: buttonValue,
            username: username,
            password: password
        };

        $.ajax({
            type: "POST",
            url: "../adm/backCode/lognpg.php",
            data: dataToSend,
            success: function (response) {
               // console.log("Raw server response:", response); // Log the raw response
                 /*   Swal.fire({
                        title: "The Internet?",
                        text: response,
                        icon: "question"
                        });*/
               // alert(response);
                try {
                    var responseObject = JSON.parse(response);

                    if (response == "1" || response == "2") {
                        window.location.href = "../adm/index.php";
                    }else if(response == "3"){
                        window.location.href = "../adm/users-profile.php";
                    }else {
                        window.location.href = "../index.php";
                    }
                } catch (error) {
                    console.error("Error parsing JSON: ", error);
                    //alert("Error parsing server response.");
                        window.location.href = "../index.php";
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed:", status, error);
                //alert("AJAX request failed. Check console for details.");
            }
        });
    });
});

</script>

<!-- ... Your existing code ... -->

</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/img/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">
                                    Daphne Lord School
                                </p>
                            </div>

                            <div class="form-group first">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" autocompleted>
                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" autocompleted>
                            </div>
                            <div class="d-flex mb-5 align-items-center">

                                <!--<span class="ml-auto"><a href="forgetPas_section.php" class="forgot-pass" disabled>Forgot-->
                                <!--        Password</a></span>-->
                            </div>
                            <button class="btn btn-block btn-primary btn-sm" id="log" value="200">Log In</button>
                            <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"
        integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
        data-cf-beacon='{"rayId":"8291390c2f64b309","b":1,"version":"2023.10.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
</body>

</html>
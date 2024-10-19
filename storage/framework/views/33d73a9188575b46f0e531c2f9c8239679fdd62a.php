
<script type="text/javascript" src="<?php echo e(eventmie_asset('js/manifest.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(route('eventmie.eventmie_lang')); ?>"></script>



<script type="text/javascript">
    const my_lang = <?php echo json_encode(session('my_lang', \Config::get('app.locale'))); ?>;
    const timezone_conversion = <?php echo json_encode(!empty(setting('regional.timezone_conversion')) ? 1 : 0); ?>;
    const timezone_default = <?php echo json_encode(setting('regional.timezone_default')); ?>;


    const date_format = {
        vue_date_format: '<?php echo format_js_date(); ?>',
        vue_time_format: '<?php echo format_js_time(); ?>'
    };
</script>




<script type="text/javascript">
    /**
     * Header menu onscroll 
     */
    var lastScrollTop = 0;

    function handleScroll() {
        let el = document.getElementById('navbar_vue');
        let st = window.pageYOffset || document.documentElement.scrollTop;

        lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
        if (window.scrollY > 1) {
            // el.classList.add('shadow');
            // el.classList.add('menu-fixed');
        } else {
            // el.classList.remove('shadow');
            // el.classList.remove('menu-fixed');

            if (el.classList.contains('is-active')) {
                el.classList.add('is-mobile');
            }
        }
    };

    function scrollListener(obj, type, fn) {
        if (obj.attachEvent) {
            obj['e' + type + fn] = fn;
            obj[type + fn] = function() {
                obj['e' + type + fn](window.event);
            };
            obj.attachEvent('on' + type, obj[type + fn]);
        } else {
            obj.addEventListener(type, fn, false);
        }
    }

    scrollListener(window, 'scroll', function(e) {
        handleScroll();
    });

    // dashboard  Toggle
    function clickToggle() {
        let dbWrapperTwo = document.getElementById("db-wrapper-two");
        let dbWrapper = document.getElementById("db-wrapper");
        sideToggle(dbWrapperTwo, dbWrapper);
    }

    //dashboard Toggle
    sideToggle = (dbWrapperTwo, dbWrapper) => {
        if (dbWrapper.classList == '' || dbWrapperTwo == '') {
            dbWrapperTwo.classList.add('toggled');
            dbWrapper.classList.add('toggled');
        } else {
            dbWrapperTwo.classList.remove('toggled');
            dbWrapper.classList.remove('toggled');
        }
    }

    // Copy to clipboard
    function copyToClipboard() {
        var dummy = document.createElement('input'),
            text = window.location.href;

        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);

        alert('Event URL Copied!')
    }


    // set local timezone 
    var local_timezone = <?php echo json_encode(route('eventmie.local_timezone')); ?>;

    function setLocalTimezone() {
        // Making our request
        fetch(local_timezone, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    local_timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
                })
            })
            .then(Result => Result.json())
            .then(string => {
                console.log('lang', string);
            })
            .catch(errorMsg => {
                console.log(errorMsg);
            });
    }

    setLocalTimezone();



    // Bootstrap Dropdown using JS Script
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButtons = document.querySelectorAll(".dropdown-toggle");
        const dropdownMenus = document.querySelectorAll(".dropdown-menu");

        if (dropdownButtons || dropdownMenus) {
            // Add click event listeners to each dropdown button
            dropdownButtons.forEach((button, index) => {
                button.addEventListener("click", function() {
                    // Toggle the visibility of the corresponding dropdown menu
                    if (dropdownMenus[index].style.display === "none" || dropdownMenus[index]
                        .style
                        .display === "") {
                        dropdownMenus[index].style.display = "block";
                        dropdownMenus[index].style.border = "1px solid #fff";
                        dropdownMenus[index].classList.add('show', 'shadow');
                    } else {
                        dropdownMenus[index].style.display = "none";
                        dropdownMenus[index].classList.remove('show', 'shadow');
                    }
                });
            });

            // Close all dropdowns if the user clicks outside of any dropdown
            document.addEventListener("click", function(event) {
                dropdownButtons.forEach((button, index) => {
                    if (!button.contains(event.target) && !dropdownMenus[index].contains(event
                            .target)) {
                        dropdownMenus[index].style.display = "none";
                        dropdownMenus[index].style.border = "1px solid #fff";
                        dropdownMenus[index].classList.remove('show', 'shadow');
                    }
                });
            });
        }
    });
</script>


<!-- Libs JS --> 
<script src="assets/vendor/jquery/dist/jquery.min.js"></script> 
<script src="assets/vendor/popper.js/dist/popper.min.js"></script> 
<script src="assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script> 
<script src="assets/vendor/fullPage.js/dist/scrolloverflow.min.js"></script> 
<script src="assets/vendor/fullPage.js/dist/jquery.fullpage.min.js"></script> 
<script src="assets/vendor/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/vendor/jquery-smooth-scroll/jquery.smooth-scroll.min.js"></script> 
<script src="assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script> 
<script src="assets/vendor/jquery-form/dist/jquery.form.min.js"></script> 
<script src="assets/vendor/granim.js/dist/granim.min.js"></script> 
<script src="assets/vendor/slick/slick.min.js"></script> 
<script src="assets/vendor/vegas/vegas.min.js"></script> 

<!-- Theme JS --> 
<script src="assets/js/main.js"></script>

<?php /**PATH /var/www/vhosts/getyourticket.events/httpdocs/public/resources/views/vendor/eventmie/layouts/include_js.blade.php ENDPATH**/ ?>
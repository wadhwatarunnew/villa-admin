$(document).ready(function() {
    var $sidebar = $('.sidebarDiv');
    var $menuItems = $sidebar.find('.menu-link');

    // Default: all collapsible groups closed.
    $menuItems.removeClass('open');
    $menuItems.children('.br-menu-sub').hide();

    function openMenuItem($item) {
        $item.addClass('open');
        $item.children('.br-menu-sub').stop(true, true).slideDown(180);
    }

    function closeOtherMenuItems($current) {
        $current.siblings('.menu-link').removeClass('open').children('.br-menu-sub').stop(true, true).slideUp(180);
    }

    function closeNestedMenus($item) {
        $item.find('.menu-link').removeClass('open').children('.br-menu-sub').hide();
    }

    // Keep current page parent expanded on load.
    var currentPath = window.location.pathname.split('/').pop();
    if (currentPath) {
        var $activeLink = $sidebar.find('.br-menu-sub a').filter(function() {
            var href = ($(this).attr('href') || '').split('/').pop();
            return href === currentPath;
        }).first();

        if ($activeLink.length) {
            var $activeParents = $activeLink.parents('.menu-link');
            $activeParents.each(function() {
                openMenuItem($(this));
            });
        }
    }

    // Toggle only when clicking a parent expandable title.
    $sidebar.on('click', '.menu-link > .br-menu-link', function(e) {
        e.preventDefault();

        var $parent = $(this).closest('.menu-link');
        var $submenu = $parent.children('.br-menu-sub');
        if (!$submenu.length) {
            return;
        }

        var isOpen = $parent.hasClass('open');

        if (isOpen) {
            $parent.removeClass('open');
            $submenu.stop(true, true).slideUp(180);
            closeNestedMenus($submenu);
        } else {
            closeOtherMenuItems($parent);
            openMenuItem($parent);
        }
    });

    // Prevent parent toggle from submenu item clicks.
    $sidebar.on('click', '.br-menu-sub a', function(e) {
        e.stopPropagation();
    });
});
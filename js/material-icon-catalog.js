(function () {
    'use strict';

    var metadataUrl = 'material-icons.php';

    function appendMissingIcons(iconNames) {
        var grids = document.querySelectorAll('.icon-picker-grid');

        Array.prototype.forEach.call(grids, function (grid) {
            var existingNames = {};

            Array.prototype.forEach.call(
                grid.querySelectorAll('.icon-picker-item[data-icon]'),
                function (item) {
                    existingNames[item.getAttribute('data-icon')] = true;
                }
            );

            iconNames.forEach(function (name) {
                if (existingNames[name]) {
                    return;
                }

                var button = document.createElement('button');
                var icon = document.createElement('span');
                var label = document.createElement('span');

                button.type = 'button';
                button.className = 'icon-picker-item';
                button.setAttribute('data-icon', name);
                button.setAttribute('title', name);

                icon.className = 'material-icons';
                icon.textContent = name;
                label.className = 'icon-picker-label';
                label.textContent = name;

                button.appendChild(icon);
                button.appendChild(label);
                grid.appendChild(button);
            });
        });
    }

    function loadIconCatalog() {
        if (Array.isArray(window.materialIconNames) && window.materialIconNames.length) {
            appendMissingIcons(window.materialIconNames);

            if (window.MutationObserver && document.body) {
                new MutationObserver(function () {
                    appendMissingIcons(window.materialIconNames);
                }).observe(document.body, {
                    childList: true,
                    subtree: true
                });
            }
            return;
        }

        fetch(metadataUrl)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Unable to load Material Icons metadata');
                }
                return response.text();
            })
            .then(function (content) {
                var metadata = JSON.parse(content);
                var iconNames = metadata.icons
                    .map(function (icon) {
                        return icon.name;
                    })
                    .filter(function (name, index, names) {
                        return name && names.indexOf(name) === index;
                    });

                appendMissingIcons(iconNames);

                if (window.MutationObserver && document.body) {
                    new MutationObserver(function () {
                        appendMissingIcons(iconNames);
                    }).observe(document.body, {
                        childList: true,
                        subtree: true
                    });
                }
            })
            .catch(function () {
                // The built-in list remains available when the catalog cannot be fetched.
            });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            window.setTimeout(loadIconCatalog, 0);
        });
    } else {
        window.setTimeout(loadIconCatalog, 0);
    }
}());

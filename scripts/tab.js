// jQuery(document).ready(function ($) {
//     var tab = $("#tabs .tabs-items > div");
//     tab.hide().filter(":first").show();

//     // Клики по вкладкам.
//     $("#tabs .tabs-navSelector a")
//         .click(function () {
//             tab.hide();
//             tab.filter(this.hash).show();
//             $("#tabs .tabs-navSelector a").removeClass("active");
//             $(this).addClass("active");
//             console.log("asdfa");
//             return false;
//         })
//         .filter(":first")
//         .click();

//     // Клики по якорным ссылкам.
//     $(".tabs-target").click(function () {
//         $("#tabs .tabs-navSelector a[href=" + $(this).attr("href") + "]").click();
//     });

//     // Отрытие вкладки из хеша URL
//     // if (window.location.hash) {
//     //     $("#tabs-navSelector a[href=" + window.location.hash + "]").click();
//     //     window.scrollTo(0, $("#".window.location.hash).offset().top);
//     // }
// });

class TabsControl {
    constructor(navSelector, tabsHeadersSelector, tabsContentsSelector) {
        this.tabs = [];
        this.activeTab = null;
        this.init(navSelector, tabsHeadersSelector, tabsContentsSelector);
    }

    init(navSelector, tabsHeadersSelector, tabsContentsSelector) {
        const tabHeader = document.querySelectorAll(
            `${navSelector} ${tabsHeadersSelector} li`
        );
        const tabContent = document.querySelectorAll(
            `${navSelector} ${tabsContentsSelector} div`
        );
        for (let i = 0; i < tabHeader.length; i++) {
            this.registerTab(tabHeader[i], tabContent[i]);
        }

        this.activateTab(this.tabs[0]);
        this.addTabClasses();
    }

    addTabClasses() {
        for (const iterator of this.tabs) {
            iterator.tabHeader.classList.add("tab-header");
            iterator.tabContent.classList.add("tab-content");
        }
    }

    registerTab(tabHeader, tabContent) {
        const tab = new TabItem(tabHeader, tabContent);
        tab.onActivate(() => this.activateTab(tab));
        this.tabs.push(tab);
    }

    activateTab(tab) {
        if (this.activeTab == tab) {
            return;
        }
        if (this.activeTab) {
            this.activeTab.setActive(false);
        }
        this.activeTab = tab;
        this.activeTab.setActive(true);
    }
}

class TabItem {
    constructor(tabHeader, tabContent) {
        this.tabHeader = tabHeader;
        this.tabContent = tabContent;
    }

    onActivate(action) {
        this.tabHeader.addEventListener("click", () => action(this));
    }
    setActive(value) {
        this.tabHeader.classList.toggle("active-tab-header", value);
        this.tabContent.classList.toggle("active-tab-content", value);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new TabsControl(".nav-tabs", ".tabs-headers", ".tabs-contents");
});

jQuery(document).ready(function ($) {
    const search_input = $(".search-form__input");
    const search_results = $(".ajax-search");

    search_input.keyup(function () {
        let search_value = $(this).val();

        if (search_value.length > 2) {
            // кол-во символов
            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                type: "POST",
                data: {
                    action: "ajax_search", // functions.php
                    term: search_value,
                },
                success: function (results) {
                    search_results.fadeIn(200).html(results);
                },
            });
        } else {
            search_results.fadeOut(200);
        }
    });

    // Закрытие поиска при клике вне его
    $(document).mouseup(function (e) {
        if (
            search_input.has(e.target).length === 0 &&
            search_results.has(e.target).length === 0
        ) {
            search_results.fadeOut(200);
        }
    });
});

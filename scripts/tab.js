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
    new ModalWindowMabager(".window-opening-button");
});

class ModalWindowMabager {
    constructor(selector) {
        this.closeModalWindow = this.closeModalWindow.bind(this);
        this.openModalWindow = this.openModalWindow.bind(this);

        this.init(selector);
    }

    init(selector) {
        const modalButtons = document.querySelectorAll(selector);

        for (let i = 0; i < modalButtons.length; i++) {
            modalButtons[i].addEventListener("click", this.openModalWindow);
        }

        this.updateForm();

        if (!document.querySelector("#callback-name")) {
            this.openModalWindow({
                target: document.body,
            });

            this.modalWindow.addEventListener("click", this.closeModalWindow);
        }
    }

    updateForm() {
        this.modalBg = document.createElement("div");
        this.modalBg.classList.add("modal-bg");
        document.body.append(this.modalBg);

        this.modalWindow = document.createElement("div");
        this.modalWindow.classList.add("modal-window");
        document.body.append(this.modalWindow);
        this.modalWindow.append(document.querySelector(".contact-form"));

        this.modalWindowHead = document.createElement("div");
        this.windowHeading = document.createElement("h3");
        this.closeButton = document.createElement("button");

        this.closeButton.innerText = "×";
        this.closeButton.classList.add("close-button");
        this.modalWindowHead.classList.add("modal-window-head");

        this.modalWindow.firstElementChild.prepend(this.modalWindowHead);
        this.modalWindowHead.append(this.windowHeading);
        this.modalWindowHead.append(this.closeButton);
    }

    openModalWindow(event) {
        if (event.target.closest(".reqPrice")) {
            this.setHeading("Запрос цены");
        } else if (event.target.closest(".order")) {
            this.setHeading("Отправить заявку");
        } else {
            this.windowHeading.innerHTML = "Запрос отправлен. Спасибо!";
        }

        document.body.classList.add("modal");
        this.modalWindow.classList.add("modal-window-opened");
        this.modalBg.classList.add("modal-bg-opened");

        document.addEventListener("click", this.closeModalWindow);
    }

    closeModalWindow(event) {
        let target = event.target;

        if (target == this.closeButton || target == this.modalBg) {
            document.body.classList.remove("modal");
            this.modalWindow.classList.remove("modal-window-opened");
            this.modalBg.classList.remove("modal-bg-opened");

            document.removeEventListener("click", this.closeModalWindow);
        }
    }

    setHeading(heading) {
        if (document.querySelector("#callback-name")) {
            this.windowHeading.innerHTML = heading;
        } else {
            this.windowHeading.innerHTML = "Запрос отправлен. Спасибо!";
        }
    }
}

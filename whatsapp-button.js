(function() {
    // اطمینان حاصل کنید که تنظیمات در window.whatsappButtonConfig تعریف شده باشد
    const config = window.whatsappButtonConfig || {};

    const whatsappNumber = config.whatsappNumber || null;
    const whatsappColor = config.whatsappColor || "#25D366";
    const defaultMessage = config.defaultMessage || "سلام در رابطه با سایت " + window.location.hostname + " سوالی داشتم";
    const buttonText = config.buttonText || "گفتگو در واتساپ"; // متن کنار آیکون واتساپ
    const callNumber = config.callNumber || null;
    const callColor = config.callColor || "#6f42c1"; // بنفش زیبا
    const callButtonText = config.callButtonText || "تماس با کارشناس";

    // --- تنظیمات ثابت داخلی اسکریپت ---
    const position = {
        bottom: '20px',
        right: '20px' // می‌توانید اینجا 'left' یا 'right' را تغییر دهید
    };
    const initialDelay = 3; // تاخیر اولیه (ثانیه) قبل از شروع انیمیشن باز شدن
    const expandDuration = 0.7; // مدت زمان (ثانیه) انیمیشن باز شدن دکمه
    const expandedStayDuration = 4; // مدت زمان (ثانیه) که دکمه در حالت باز می‌ماند
    const collapseDuration = 0.5; // مدت زمان (ثانیه) انیمیشن بسته شدن دکمه
    const hoverExpandDuration = 0.3; // مدت زمان (ثانیه) انیمیشن باز شدن هنگام هاور

    const initialWidth = '50px'; // عرض اولیه دکمه (فقط آیکون)
    const expandedWidth = '200px'; // عرض دکمه در حالت باز شده
    
    // --- پایان تنظیمات ---

    const style = document.createElement('style');
    style.innerHTML = `
        .whatsapp-buttons-wrapper {
            position: fixed;
            ${position.bottom ? `bottom: ${position.bottom};` : ''}
            ${position.right ? `right: ${position.right};` : ''}
            ${position.left ? `left: ${position.left};` : ''}
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: ${position.left ? 'flex-start' : 'flex-end'};
            gap: 10px;
            direction: ltr;
        }

        .whatsapp-button-container, .call-button-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            cursor: pointer;
            text-decoration: none;
            overflow: hidden;
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: width ${hoverExpandDuration}s ease-in-out; /* برای انیمیشن هاور */
            width: ${initialWidth}; /* همیشه با عرض اولیه شروع شود */
            height: ${initialWidth};
            direction: rtl;
        }

        .whatsapp-button-container {
            background-color: ${whatsappColor};
        }

        .call-button-container {
            background-color: ${callColor};
        }


        .whatsapp-button-container.is-expanded, .call-button-container.is-expanded {
            width: ${expandedWidth};
        }
        .whatsapp-button-container.is-expanded .whatsapp-button-text,
        .call-button-container.is-expanded .whatsapp-button-text {
            opacity: 1;
        }

        .whatsapp-button-icon {
            flex-shrink: 0;
            width: 60%;
            height: 60%;
            margin: 20%;
            fill: white;
            transition: margin ${hoverExpandDuration}s ease-in-out, width ${hoverExpandDuration}s ease-in-out, height ${hoverExpandDuration}s ease-in-out;
        }
        .whatsapp-button-container.is-expanded .whatsapp-button-icon,
        .call-button-container.is-expanded .whatsapp-button-icon {
            margin: 10px; /* مارجین پس از باز شدن دکمه */
            width: 30px;
            height: 30px;
        }

        .whatsapp-button-text {
            color: white;
            font-size: 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-left: 10px;
            padding-right: 15px;
            direction: rtl;
            opacity: 0;
            flex-grow: 1;
            text-align: right;
            transition: opacity ${hoverExpandDuration}s ease-in-out; /* برای انیمیشن هاور */
        }
    `;
    document.head.appendChild(style);

    const buttonsWrapper = document.createElement('div');
    buttonsWrapper.className = "whatsapp-buttons-wrapper";
    document.body.appendChild(buttonsWrapper);

    const createButton = (href, className, iconSvg, text) => {
        const btn = document.createElement('a');
        btn.href = href;
        btn.target = "_blank";
        btn.rel = "noopener noreferrer";
        btn.className = className;

        const txt = document.createElement('span');
        txt.className = "whatsapp-button-text";
        txt.textContent = text;
        btn.appendChild(txt);

        btn.insertAdjacentHTML('beforeend', iconSvg);

        return btn;
    };

    const whatsappIconSvg = `
        <svg class="whatsapp-button-icon" viewBox="0 0 24 24" >
            <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z" fill="#fff"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z" fill="#fff"/>
        </svg>
    `;

    const callIconSvg = `
        <svg class="whatsapp-button-icon" viewBox="0 0 24 24">
            <path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="#fff"/>
        </svg>
    `;

    const buttons = [];

    if (callNumber) {
        const callBtn = createButton(`tel:${callNumber}`, "call-button-container", callIconSvg, callButtonText);
        buttonsWrapper.appendChild(callBtn);
        buttons.push(callBtn);
    }

    if (whatsappNumber) {
        const whatsappLink = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(defaultMessage)}`;
        const whatsappBtn = createButton(whatsappLink, "whatsapp-button-container", whatsappIconSvg, buttonText);
        buttonsWrapper.appendChild(whatsappBtn);
        buttons.push(whatsappBtn);
    }

    if (buttons.length === 0) {
        buttonsWrapper.remove();
        return;
    }

    const expandButton = (btn) => {
        btn.style.width = expandedWidth;
        btn.querySelector('.whatsapp-button-text').style.opacity = 1;
        btn.classList.add('is-expanded');
    };

    const collapseButton = (btn) => {
        btn.style.width = initialWidth;
        btn.querySelector('.whatsapp-button-text').style.opacity = 0;
        btn.classList.remove('is-expanded');
    };

    // انیمیشن اولیه
    setTimeout(() => {
        buttons.forEach((btn, index) => {
            setTimeout(() => {
                btn.style.transition = `width ${expandDuration}s ease-out`;
                btn.querySelector('.whatsapp-button-text').style.transition = `opacity ${expandDuration * 0.5}s ease-in ${expandDuration * 0.5}s`;
                expandButton(btn);

                setTimeout(() => {
                    btn.style.transition = `width ${collapseDuration}s ease-in-out`;
                    btn.querySelector('.whatsapp-button-text').style.transition = `opacity ${collapseDuration * 0.5}s ease-out`;
                    collapseButton(btn);

                    setTimeout(() => {
                        btn.style.transition = `width ${hoverExpandDuration}s ease-in-out`;
                        btn.querySelector('.whatsapp-button-text').style.transition = `opacity ${hoverExpandDuration}s ease-in-out`;
                    }, collapseDuration * 1000);
                }, expandedStayDuration * 1000 + expandDuration * 1000);
            }, index * 1000); // تاخیر بین دکمه‌ها
        });
    }, initialDelay * 1000);

    // مدیریت هاور
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', () => expandButton(btn));
        btn.addEventListener('mouseleave', () => collapseButton(btn));
    });

})();
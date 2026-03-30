<div id="chat-popup" class="chat-popup">

    <div class="popup-inner">

        <div class="close-chat"><i class="fa fa-times"></i></div>

        <div class="chat-form">

            <p>Please fill out the form below and we will get back to you as soon as possible.</p>

            <form action="assets/inc/sendemail.php" method="POST" class="contact-form-validated">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message" placeholder="Your Text" required></textarea>
                </div>
                <div class="form-group message-btn">
                    <button type="submit" class="thm-btn"> Submit Now
                        <span class="fas fa-arrow-right"></span>
                    </button>
                </div>
                <div class="result"></div>
            </form>

        </div>

    </div>

</div>

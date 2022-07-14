<h1 class="pageHeader">Contact Us!</h1>
<div class="contactContent loginContent">
    <form action="<?= site_url() ?>/main/sendMessage" method="post">
        <label for="contactName">Name:</label>
        <input type="text" name="contactName" id="contactName">
        <label for="contactEmail">Email:</label>
        <input type="email" name="contactEmail">
        <textarea name="contactMessage" id="" cols="30" rows="10" placeholder="Type your message here"
            style="width: clamp(210px, 300px, 360px); margin: 0; margin-top: 25px"></textarea>
        <button class="goToButton" type="submit">Send Message</button>
    </form>
    <div class="divLine"></div>
    <div class="contactInfo">
        <p>Address: 1102 w Water St.</p>
        <p>Email: watermusicstore@gmail.com</p>
        <p>Phone: 219-555-4732</p>
    </div>
</div>
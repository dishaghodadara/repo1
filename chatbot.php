<!-- chatbot.php -->
<div id="chatbot" style="
    position:fixed;
    bottom:20px;
    right:20px;
    width:320px;
    font-family:'Roboto', sans-serif;
    z-index:1000;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
">

    <!-- Chat Header -->
    <div style="
        background:#4CAF50;
        color:white;
        padding:12px;
        font-weight:700;
        border-radius:15px 15px 0 0;
        cursor:pointer;
        text-align:center;
    " onclick="toggleChat()">💬 How can we help you?</div>

    <!-- Chat Body -->
    <div id="chatBody" style="
        display:none;
        background:#f5f7ff;
        border-radius:0 0 15px 15px;
        max-height:350px;
        overflow-y:auto;
        padding:10px;
    ">
        <div id="chatOptions" style="margin-bottom:10px;"></div>
        <div id="chatAnswer"></div>
    </div>
</div>

<script>
// Predefined questions and answers
const qaList = [
    {q:"What loan types do you offer?", a:"We offer Car, Home, Health, Education, and Personal loans."},
    {q:"How can I apply for a loan?", a:"You can apply from the loan details page by entering amount and term, then clicking Apply."},
    {q:"How is EMI calculated?", a:"Use the EMI calculator on the apply page to check monthly payments."},
    {q:"Contact details?", a:"Call us at 123-456-7890 or email at support@loanwebsite.com."}
];

const chatOptions = document.getElementById('chatOptions');
const chatAnswer = document.getElementById('chatAnswer');

// Add buttons for questions
qaList.forEach(item => {
    const btn = document.createElement('button');
    btn.innerText = item.q;
    btn.style.width = "100%";
    btn.style.marginBottom = "8px";
    btn.style.padding = "10px";
    btn.style.cursor = "pointer";
    btn.style.border = "none";
    btn.style.borderRadius = "20px";
    btn.style.background = "#4CAF50";
    btn.style.color = "white";
    btn.style.fontWeight = "500";
    btn.onclick = () => addAnswer(item.q, item.a);
    chatOptions.appendChild(btn);
});

// Add answer as bubble
function addAnswer(question, answer){
    // Question bubble
    let qBubble = document.createElement('div');
    qBubble.innerText = question;
    qBubble.style.background = "#d1f0ff";
    qBubble.style.padding = "10px";
    qBubble.style.borderRadius = "15px";
    qBubble.style.marginBottom = "5px";
    qBubble.style.textAlign = "left";
    
    // Answer bubble
    let aBubble = document.createElement('div');
    aBubble.innerText = answer;
    aBubble.style.background = "#e0e0e0";
    aBubble.style.padding = "10px";
    aBubble.style.borderRadius = "15px";
    aBubble.style.marginBottom = "10px";
    aBubble.style.textAlign = "left";

    chatAnswer.appendChild(qBubble);
    chatAnswer.appendChild(aBubble);
    chatAnswer.scrollTop = chatAnswer.scrollHeight;
}

// Toggle chat
function toggleChat(){
    const body = document.getElementById('chatBody');
    body.style.display = (body.style.display==="none" || body.style.display==="") ? "block" : "none";
}
</script>

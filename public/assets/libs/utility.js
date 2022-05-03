// Utilities
(function () {
  
    // chat emojiPicker input
    new FgEmojiPicker({
      trigger: [".emoji-btn"],
      removeOnSelection: false,
      closeButton: true,
      position: ["top", "right"],
      preFetch: true,
      dir: "assets/libs/fg-emoji-picker/",
      insertInto: document.querySelector(".chat-input"),
    });
  
    
    // emojiPicker position
    var emojiBtn = document.getElementById("emoji-btn");
    if (emojiBtn) {
      emojiBtn.addEventListener("click", function () {
        setTimeout(function () {
          var fgEmojiPicker = document.getElementsByClassName("fg-emoji-picker")[0];
          if (fgEmojiPicker) {
            var leftEmoji = window.getComputedStyle(fgEmojiPicker)
              ? window.getComputedStyle(fgEmojiPicker).getPropertyValue("left")
              : "";
            if (leftEmoji) {
              leftEmoji = leftEmoji.replace("px", "");
              leftEmoji = leftEmoji - 40 + "px";
              fgEmojiPicker.style.left = leftEmoji;
            }
          }
        }, 0);
      });
    }
    
  
    // Password Peek
    var pwdEye = document.getElementById("password-addon");
    if(pwdEye){
      pwdEye.addEventListener("click", function() {
          var e = document.getElementById("password-input");
          "password" === e.type ? e.type = "text" : e.type = "password"
      });
    }
  
  
    // Chat Pane
    var chatPane = document.getElementById("channelList");
    var genChatPane = document.getElementById("genChat");
    var returnContacts = document.getElementById("return-contacts");
  
    if(chatPane && returnContacts && genChatPane){
        chatPane.addEventListener("click", function() {
          var e = document.getElementById("chat-pane");
          e.classList.toggle("user-chat-show");
        });

        genChatPane.addEventListener("click", function() {
          var e = document.getElementById("chat-pane");
          e.classList.toggle("user-chat-show");
        });
  
        returnContacts.addEventListener("click", function() {
          var e = document.getElementById("chat-pane");
          e.classList.toggle("user-chat-show");
      });
    }
  
  
    // Navbar Menu List
    var navList = document.getElementById("nav-item-list"); 
    if(navList){
        var profile = document.getElementById("nav-item-profile");
        var chats = document.getElementById("nav-item-chats");
        var users = document.getElementById("nav-item-users");
        var channels = document.getElementById("nav-item-channels");
        var logout = document.getElementById("nav-item-logout");
  
        var inner_navbar = document.getElementById("inner-navbar");
        var pane_chat = document.getElementById("chat-pane");
        var pane_user = document.getElementById("user-pane");
        var pane_channel = document.getElementById("channel-pane");
  
        pane_chat.style.display = 'block';
        pane_user.style.display = 'none';
        pane_channel.style.display = 'none';
  
        profile.addEventListener("click", function() {
          inner_navbar.style.display = 'block';
          pane_chat.style.display = 'block';
          pane_user.style.display = 'none';
          pane_channel.style.display = 'none';
        });
  
        chats.addEventListener("click", function() {
          inner_navbar.style.display = 'block';
          pane_chat.style.display = 'block';
          pane_user.style.display = 'none';
          pane_channel.style.display = 'none';
        });
  
        users.addEventListener("click", function() {
          inner_navbar.style.display = 'none';
          pane_chat.style.display = 'none';
          pane_user.style.display = 'block';
          pane_channel.style.display = 'none';
        });
  
        channels.addEventListener("click", function() {
          inner_navbar.style.display = 'none';
          pane_chat.style.display = 'none';
          pane_user.style.display = 'none';
          pane_channel.style.display = 'block';
        });
  
        logout.addEventListener("click", function() {
          if(confirm('Are you sure you want to logout?')){
              window.location.href = "/logout";
          }
        });
    }
  
  })();
  
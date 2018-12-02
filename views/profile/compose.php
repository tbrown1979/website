<?php
namespace Destiny;
use Destiny\Common\Session\Session;
use Destiny\Common\User\UserRole;
?>
<div class="modal message-composition" id="compose" tabindex="-1" role="dialog" aria-labelledby="composeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mr-auto" id="composeLabel">New message</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div id="compose-form">
                <div class="modal-recipients">
                    <div class="modal-user-groups" class="clearfix">
                        <?php
                        /*<?php if(Session::hasRole(UserRole::ADMIN)): ?>
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-sm btn-primary">Add group</button>
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="groups dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="#">T4 Subscribers</a></li>
                                <li><a href="#">T3 Subscribers</a></li>
                                <li><a href="#">T2 Subscribers</a></li>
                                <li><a href="#">T1 Subscribers</a></li>
                            </ul>
                        </div>
                        <?php endif ?>*/
                        ?>
                        <input tabindex="1" id="compose-recipients" type="text" placeholder="Enter a recipient ..." autocomplete="false" autocorrect="off" spellcheck="false" />
                    </div>
                    <div class="recipient-container"></div>
                </div>
                <div class="modal-body">
                    <textarea id="compose-message" tabindex="3" autocomplete="false" autocorrect="off"></textarea>
                </div>
                <div class="modal-footer">
                    <button accesskey="s" id="modal-send-btn" tabindex="5" type="button" class="btn btn-primary" data-loading-text="Sending...">Send</button>
                    <button id="modal-close-btn" tabindex="3" type="button" class="btn btn-default">Cancel</button>
                    <span class="modal-message">To send press <code>ctrl + enter</code> or <code>alt + s</code></span>
                </div>
            </div>
        </div>
    </div>
</div>
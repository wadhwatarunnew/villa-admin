<?php $PageTitle = "Villatent: Contact Cards"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="listing-page-head">
                        <div class="listing-title-wrap">
                            <h1>Contact Cards</h1>
                            <div class="listing-breadcrumb">
                                <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Contact Us</span><span class="crumb-sep">&gt;</span><span>Contact Cards</span>
                            </div>
                        </div>
                        <div class="listing-cta">
                            <a href="contact-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#contactCardModal"><i class="feather icon-plus"></i> Add Card</button>
                        </div>
                    </div>

                    <div class="card mb-30">
                        <div class="card-header">SEO Meta Tags</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="commonSection">
                                        <label>Meta Title</label>
                                        <textarea class="form-control" placeholder="Enter meta title"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="commonSection">
                                        <label>Meta Keyword</label>
                                        <textarea class="form-control" placeholder="Enter meta keyword"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="commonSection mb-0">
                                        <label>Meta Description</label>
                                        <textarea class="form-control" placeholder="Enter meta description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-30">
                        <div class="card-header">Contact Information Cards</div>
                        <div class="card-body">
                            <p class="listing-info-text" style="margin-top:0; margin-bottom:12px;">These details will be shown in the contact detail section.</p>
                            <div class="contact-cards-grid" id="contactCardsGrid">
                                <div class="contact-info-card">
                                    <div class="contact-card-actions-row">
                                        <span class="contact-card-handle material-icons">drag_indicator</span>
                                        <div class="contact-card-actions">
                                            <button type="button" class="btn btn-link p-0 edit-contact-card-btn" title="Edit Card"><i class="material-icons">edit</i></button>
                                            <button type="button" class="btn btn-link p-0 delete-contact-card-btn" title="Delete Card"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                    <div class="contact-card-icon-wrap"><span class="material-icons card-icon-name">call</span></div>
                                    <h3 class="card-title">CALL US</h3>
                                    <p class="contact-card-line">+91 9813627021</p>
                                    <p class="contact-card-line">+91 9817707021</p>
                                    <p class="contact-card-note">Mon - Sat: 9:30 AM - 6:30 PM</p>
                                </div>

                                <div class="contact-info-card">
                                    <div class="contact-card-actions-row">
                                        <span class="contact-card-handle material-icons">drag_indicator</span>
                                        <div class="contact-card-actions">
                                            <button type="button" class="btn btn-link p-0 edit-contact-card-btn" title="Edit Card"><i class="material-icons">edit</i></button>
                                            <button type="button" class="btn btn-link p-0 delete-contact-card-btn" title="Delete Card"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                    <div class="contact-card-icon-wrap"><span class="material-icons card-icon-name">mail</span></div>
                                    <h3 class="card-title">EMAIL US</h3>
                                    <p class="contact-card-line">info@thevillatent.com</p>
                                    <p class="contact-card-note">We reply within 24 hours</p>
                                </div>

                                <div class="contact-info-card">
                                    <div class="contact-card-actions-row">
                                        <span class="contact-card-handle material-icons">drag_indicator</span>
                                        <div class="contact-card-actions">
                                            <button type="button" class="btn btn-link p-0 edit-contact-card-btn" title="Edit Card"><i class="material-icons">edit</i></button>
                                            <button type="button" class="btn btn-link p-0 delete-contact-card-btn" title="Delete Card"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                    <div class="contact-card-icon-wrap"><span class="material-icons card-icon-name">whatsapp</span></div>
                                    <h3 class="card-title">WHATSAPP</h3>
                                    <p class="contact-card-line">+91 9813627021</p>
                                    <p class="contact-card-note">Chat with us on WhatsApp</p>
                                </div>

                                <div class="contact-info-card">
                                    <div class="contact-card-actions-row">
                                        <span class="contact-card-handle material-icons">drag_indicator</span>
                                        <div class="contact-card-actions">
                                            <button type="button" class="btn btn-link p-0 edit-contact-card-btn" title="Edit Card"><i class="material-icons">edit</i></button>
                                            <button type="button" class="btn btn-link p-0 delete-contact-card-btn" title="Delete Card"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                    <div class="contact-card-icon-wrap"><span class="material-icons card-icon-name">place</span></div>
                                    <h3 class="card-title">OUR OFFICE</h3>
                                    <p class="contact-card-line">The Villa Tent</p>
                                    <p class="contact-card-note">The Vedanta International Dhulkot, Behind Kingfisher, Vedanta Street, Ambala City - 134003, Haryana, India.</p>
                                </div>

                                <div class="contact-info-card">
                                    <div class="contact-card-actions-row">
                                        <span class="contact-card-handle material-icons">drag_indicator</span>
                                        <div class="contact-card-actions">
                                            <button type="button" class="btn btn-link p-0 edit-contact-card-btn" title="Edit Card"><i class="material-icons">edit</i></button>
                                            <button type="button" class="btn btn-link p-0 delete-contact-card-btn" title="Delete Card"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                    <div class="contact-card-icon-wrap"><span class="material-icons card-icon-name">schedule</span></div>
                                    <h3 class="card-title">WORKING HOURS</h3>
                                    <p class="contact-card-line">Mon - Sat</p>
                                    <p class="contact-card-line">10:00 AM - 6:30 PM</p>
                                    <p class="contact-card-note">Sunday: Closed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-30">
                        <div class="card-header">Banner Image <span class="required">*</span></div>
                        <div class="card-body">
                            <div class="banner-image-upload">
                                <img src="uploads/pageimages/slider/Ultra-Luxury-Ganesha-Resort-Tent.jpg" class="banner-image-preview" id="contact_cards_banner_preview" alt="Banner Image" onerror="this.src='images/default-profile.png';">
                                <div class="banner-recommended-size">Recommended size: 1920x800px</div>

                                <div class="radio-inline-group" style="margin-top: 12px;">
                                    <label for="contact_cards_radio_url"><input id="contact_cards_radio_url" type="radio" name="image_source" value="url">Image URL</label>
                                    <label for="contact_cards_radio_file"><input id="contact_cards_radio_file" type="radio" name="image_source" value="file" checked>Select Image</label>
                                </div>

                                <div id="contact_cards_image_url" style="display:none; margin-top: 12px;">
                                    <input class="form-control banner-form-control" type="text" id="contact_cards_image" value="" placeholder="Enter image URL">
                                </div>

                                <div id="contact_cards_select_image" style="margin-top: 12px;">
                                    <input type="file" id="contact_cards_my_file" style="display:none;" accept="image/*">
                                    <div class="banner-upload-actions">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" id="changeContactCardsImageBtn">
                                            <i class="feather icon-upload"></i> Change Image
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" id="resetContactCardsImageBtn">Reset Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade app-themed-modal" id="contactCardModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactCardModalTitle">Add Quick Info Item</h5>
                <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="material-icons">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="commonSection">
                            <label>Card Title</label>
                            <input type="text" class="form-control" id="cardTitleInput" placeholder="CALL US">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="commonSection">
                            <label>Icon</label>
                            <div class="counter-icon-box">
                                <div class="counter-icon-preview">
                                    <span class="material-icons" id="cardIconPreview">call</span>
                                </div>
                                <input type="text" class="form-control" id="cardIconInput" value="call" placeholder="call">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="commonSection">
                            <label>Line One</label>
                            <input type="text" class="form-control" id="cardLineOneInput" placeholder="+91 9813627021">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="commonSection">
                            <label>Line Two</label>
                            <input type="text" class="form-control" id="cardLineTwoInput" placeholder="+91 9817707021">
                        </div>
                    </div>
                </div>
                <div class="commonSection mb-0">
                    <label>Description / Note</label>
                    <textarea class="form-control" rows="3" id="cardNoteInput" placeholder="Mon - Sat: 9:30 AM - 6:30 PM"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm modal-cancel-btn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-sm modal-save-btn" data-dismiss="modal">Add Item</button>
            </div>
        </div>
    </div>
</div>

<style>
.contact-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
}

.app-themed-modal .modal-content {
    border-radius: 14px;
    border: 1px solid var(--color-input-border);
    box-shadow: 0 20px 44px rgba(15, 23, 42, 0.18);
    overflow: hidden;
}

.app-themed-modal .modal-header {
    padding: 20px;
    border-bottom: 1px solid var(--color-border);
}

.app-themed-modal .modal-title {
    font-size: 36px;
    font-weight: 700;
    color: var(--color-text-ink);
    margin: 0;
}

.app-themed-modal .modal-body {
    padding: 22px 20px;
}

.app-themed-modal .modal-footer {
    padding: 18px 20px;
    border-top: 1px solid var(--color-border);
    background: var(--color-bg-panel);
}

.app-themed-modal .commonSection {
    margin-bottom: 20px;
}

.app-themed-modal .commonSection label {
    font-size: 16px;
    font-weight: 600;
    color: #374151;
}

.app-themed-modal .form-control {
    min-height: 50px;
    border-radius: 12px;
    font-size: 15px;
}

.app-themed-modal textarea.form-control {
    min-height: 138px;
}

.modal-close-btn {
    opacity: 1;
    color: #6b7280;
    text-shadow: none;
}

.modal-close-btn .material-icons {
    font-size: 30px;
    line-height: 1;
}

.modal-cancel-btn {
    border-radius: 12px;
    min-width: 100px;
    background: #f3f4f6;
    border-color: #f3f4f6;
    color: #111827;
    font-weight: 600;
}

.modal-save-btn {
    border-radius: 12px;
    min-width: 130px;
    font-weight: 700;
}

.contact-info-card {
    border: 1px solid var(--color-input-border);
    border-radius: 12px;
    padding: 12px;
    background: var(--color-bg-panel);
}

.contact-card-actions-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.contact-card-handle {
    font-size: 16px;
    color: var(--color-text-muted);
}

.contact-card-actions .material-icons {
    font-size: 18px;
    color: #dc3545;
}

.contact-card-actions .edit-contact-card-btn .material-icons {
    color: #2c7a67;
}

.contact-card-icon-wrap {
    width: 56px;
    height: 56px;
    border-radius: 999px;
    margin: 0 auto 10px;
    background: #e8f6ee;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-card-icon-wrap .material-icons {
    color: #2c7a67;
    font-size: 28px;
}

.contact-info-card h3 {
    margin: 0 0 8px;
    font-size: 14px;
    font-weight: 700;
    color: #145c49;
    text-align: center;
}

.contact-card-line {
    margin: 0 0 4px;
    text-align: center;
    color: #1f2937;
    font-size: 13px;
}

.contact-card-note {
    margin: 8px 0 0;
    text-align: center;
    color: #6b7280;
    font-size: 12px;
    line-height: 1.45;
}
</style>
<?php include_once('common/footer.php'); ?>

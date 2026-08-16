<?php
    include "db.php";
    include_once('common/header.php');
    $PageTitle = "Villatent: Contact Cards";
?>

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
                        <div class="card-header">Contact Information Cards
                             <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#contactCardModal"><i class="feather icon-plus"></i> Add Card</button>
                        </div>
                        <div class="card-body">
                            <p class="listing-info-text" style="margin-top:0; margin-bottom:12px;">These details will be shown in the contact detail section.</p>
                            <div class="contact-cards-grid" id="contactCardsGrid">
                                <div class="contact-info-card">
                                    <div class="contact-card-actions-row">
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

<div class="modal fade" id="contactCardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="contactCardModalTitle">Add Card</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="commonSection">
                    <label>Card Title</label>
                    <input type="text" class="form-control" id="cardTitleInput" placeholder="CALL US">
                </div>
                <div class="commonSection">
                    <label>Icon</label>
                    <div class="counter-icon-box">
                        <div class="counter-icon-preview">
                            <span class="material-icons" id="cardIconPreview">call</span>
                        </div>
                        <input type="text" class="form-control" id="cardIconInput" value="call" placeholder="call">
                    </div>
                </div>
                <div class="row">
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
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="saveContactCard" data-bs-dismiss="modal">Add Card</button>
            </div>
        </div>
    </div>
</div>
<?php include_once('common/footer.php'); ?>

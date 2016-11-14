<?php
/*
Template Name: RCKTSHP How it works
*/
?>

<div>
    <div id="how-works-header">
        <div class="hw-banner-greeeting-wrapper">
            <h3 id="hw-banner-greeting">Quick and easy to use!</h3>
        </div>
        <ul class="tabs" id="how-works-tabs">
            <div class="large-10 push-1 columns">
                <li id="how-works-employer" class="how-works-tab current" data-tab="tab-2"><h2 class="how-works-tab-link" id="hw-emp">FOR BUSINESSES</h2></li>
                <li id="how-works-freelancer" class="how-works-tab" data-tab="tab-1"><h2 class="how-works-tab-link" id="hw-free">FOR FREELANCERS</h2></li>
            </div>
        </ul>
    </div>
    <div class="orange-bar">

        <h3 class="hw-header">Your RCKTSHP journey begins here.</h3>
    </div>

    <div id="how-works-employer-section">
       <div id="hw-emp-icons">
           <div class="large-10 push-1" id="hw-icons-wrapper">
               <div class="icon-wrapper">
                    <a href="#step1"><img alt='rocketship register' class="hw-icons" src="<?php echo
                        site_url()?>/wp-content/themes/freelancerr/images/how-works/Register.png"></a>
                    <h4>Register</h4>
               </div>
               <div class="icon-wrapper">
                   <a href="#step2"><img alt='rockathsip post a project' class="hw-icons" src="<?php echo site_url()
               ?>/wp-content/themes/freelancerr/images/how-works/Post.png"></a>
                   <h4>Post<br/> Project</h4>
               </div>
               <div class="icon-wrapper">
                   <a href="#step3"><img alt="rocketship choose a freelancer" class="hw-icons" src="<?php echo site_url()
               ?>/wp-content/themes/freelancerr/images/how-works/Choose.png"></a>
                   <h4>Choose<br/> Freelancer</h4>
               </div>
               <div class="icon-wrapper">
                   <a href="#step4"><img alt="rocketship accept proposal" class="hw-icons" src="<?php echo site_url()
               ?>/wp-content/themes/freelancerr/images/how-works/Accept.png"></a>
                   <h4>Accept<br/> Terms</h4>
               </div>
               <div class="icon-wrapper">
                    <a href="#step5"><img alt='rocketship fund a project' class="hw-icons" src="<?php echo site_url()
               ?>/wp-content/themes/freelancerr/images/how-works/Fund.png"></a>
                   <h4>Fund<br/> Project</h4>
               </div>
               <div class="icon-wrapper">
                   <a href="#step6"> <img alt='rocketship freelancer' class="hw-icons" src="<?php echo site_url()
               ?>/wp-content/themes/freelancerr/images/how-works/FreelancerWorks.png"></a>
                   <h4>Freelancer<br/> Works</h4>
               </div>
               <div class="icon-wrapper">
                   <a href="#step7"><img alt='rocketship rate and review' class="hw-icons" src="<?php echo site_url()
               ?>/wp-content/themes/freelancerr/images/how-works/EndReview.png"></a>
                   <h4>End &<br/> Review</h4>
               </div>
           </div>
       </div>
        <div class="grey-back">
            <div class="large-10 push-1 columns">
                <div class="hw-emp-steps-wrapper">
                    <div class="hw-video-button">
                        <a class="button" href="#videos">Video Instructions</a>
                    </div>
                    <h2 class="hw-heading-orange" id="step1">Step 1 - Register<h2>
                    <p class="hw-step">Set up a detailed company profile. Add a Public Email to your profile so your
                    soon-to-be freelancer can contact you. </p>
                    <h2 class="hw-heading-orange" id="step2">Step 2 - Post Project</h2>
                    <p class="hw-step">Include a detailed description of the project, deliverables, deadlines, and required
                    skills. We'll help out along the way to make sure your project is flawless before we publish it on the
                    project listing board.</p>
                    <h2 class="hw-heading-orange" id="step3">Step 3 - Choose Freelancer</h2>
                    <p class="hw-step">Compare proposals and select the applicant that best meets your business needs. Make
                    sure to specify any additional terms the freelancer must meet that weren't included in the project
                    description.</p>
                    <h2 class="hw-heading-orange" id="step4">Step 4 - Accept Terms</h2>
                    <p class="hw-step">
                        <ol class="hw-list">
                            <li>The freelancer can accept or decline your initial terms, as well as propose terms of their own for review.</li>
                            <li>You can either accept or decline the freelancers terms, and/or propose more terms and
                            negotiate to find deadlines and requirements that work for both of you.</li>
                            <li>When the terms have been mutually agreed upon, verify by selecting Accept & Start Project.</li>

                        </ol>
                    </p>
                    <p class="hw-step"> If you have no additional terms to specify, the freelancer must still agree that there are
                        no terms before the option to Accept & Start Project is available. <br /><br /> Once the project has
                        been officially assigned, a project workspace will become available where you can see all the
                        details and actions for that project.</p>
                    <h2 class="hw-heading-orange" id="step5">Step 5 - Fund Project</h2>
                    <p class="hw-step">Compare proposals and select the applicant that best meets your business needs. Make
                        sure to specify any additional terms the freelancer must meet that weren't included in the project
                        description.</p>
                    <h2 class="hw-heading-orange" id="step6">Step 6 - Freelancer Works</h2>
                    <p class="hw-step">Keep in contact with the freelancer using their provided email while they complete the project.</p>
                    <h2 class="hw-heading-orange" id="step7">Step 7 - End & Review</h2>
                    <p class="hw-step">We'll notify you when the freelancer has finished the project. Verify that the
                    project is complete by selecting Complete from the dropdown in the project workspace and clicking End
                    Project. Funds will be released to your freelancer, and you can rate and review your experience working
                    together in the project workspace.</p>
                </div>
            </div>
        </div>
        <div class="hw-videos large-10 push-1" id="videos">
                <h3 class="hw-header black">RCKTSHP Video Instructions</h3>

            <div class="row hw-employer-vids">
                <div class="large-3 medium-12 small-12 columns">
                    <?php
                    $width = '350px';
                    $height = '200px';

                    $url = 'https://www.youtube.com/watch?v=mTGlw0UKp8E';
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $id = $matches[1];
                    ?>
                    <div class="hw-video">
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="hw-video-info">
                        <h3>1. Signing up on RCKTSHP</h3>
                        <p>This video outlines the process of signing up on RCKTSHP.</p>
                    </div>
                </div>


                <div class="large-3 medium-12 small-12 columns">
                    <?php
                    $url = 'https://www.youtube.com/watch?v=7DQ1F_pUtxo';
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $id = $matches[1];
                    ?>
                    <div class="hw-video">
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="hw-video-info">
                        <h3>2. Posting a Project on RCKTSHP</h3>
                        <p>This video outlines the process of posting a project on RCKTSHP</p>
                    </div>
                </div>

                <div class="large-3 medium-12 small-12 columns">
                    <?php
                    $url = 'https://www.youtube.com/watch?v=0ituJPd-ShY';
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $id = $matches[1];
                    ?>
                    <div class="hw-video">
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="hw-video-info">
                        <h3>3. Accepting Proposals and Funding a Project on RCKTSHP</h3>
                        <p>This video outlines the process of funding a project on RCKTSHP.</p>
                    </div>
                </div>

                <div class="large-3 medium-12 small-12 columns">
                    <?php
                    $url = 'https://www.youtube.com/watch?v=fgQAd9FzekY';
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $id = $matches[1];
                    ?>
                    <div class="hw-video">
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="hw-video-info">
                        <h3>4. Marking a project complete and Reviewing Freelancer</h3>
                        <p>This video outlines the process of marking a project complete on behalf of an employer, and reviewing the freelancer who completed the project. </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grey-back centered">
            <h3 class="hw-header black">More Questions? Visit our <a href="<?php echo site_url() ?>/faq/">FAQ</a>.</h3>
        </div>

    </div>


    <div id="how-works-freelancer-section">
        <div id="hw-emp-icons" class="freelancer">
            <div class="large-10 push-1" id="hw-icons-wrapper">
                <div class="icon-wrapper-free">
                    <a href="#step1free"><img alt="rocketship freelancer register" class="hw-icons" src="<?php echo
                        site_url()?>/wp-content/themes/freelancerr/images/how-works/Register.png"></a>
                    <h4>Register</h4>
                </div>
                <div class="icon-wrapper-free">
                    <a href="#step2free"><img alt="rocketship apply to project" class="hw-icons" src="<?php echo site_url()
                        ?>/wp-content/themes/freelancerr/images/how-works/ApplyTo.png"></a>
                    <h4>Apply to<br/> Projects</h4>
                </div>
                <div class="icon-wrapper-free">
                    <a href="#step3free"><img alt="rocketship accept terms" class="hw-icons" src="<?php echo site_url()
                        ?>/wp-content/themes/freelancerr/images/how-works/Accept.png"></a>
                    <h4>Accept<br/> Terms</h4>
                </div>
                <div class="icon-wrapper-free">
                    <a href="#step4free"><img class="hw-icons" alt="rocketship await funds" src="<?php echo site_url()
                        ?>/wp-content/themes/freelancerr/images/how-works/AwaitFunds.png"></a>
                    <h4>Await<br/> Funds</h4>
                </div>
                <div class="icon-wrapper-free">
                    <a href="#step5free"> <img class="hw-icons" alt="rocketship freelancer work" src="<?php echo site_url()
                        ?>/wp-content/themes/freelancerr/images/how-works/FreelancerWorks.png"></a>
                    <h4>Work</h4>
                </div>
                <div class="icon-wrapper-free">
                    <a href="#step6free"><img alt="rocketship freelancer rating" class="hw-icons" src="<?php echo site_url()
                        ?>/wp-content/themes/freelancerr/images/how-works/EndReview.png"></a>
                    <h4>End &<br/> Review</h4>
                </div>
            </div>
    </div>
        <div class="grey-back">
            <div class="large-10 push-1 columns">
                <div class="hw-emp-steps-wrapper">
                    <div class="hw-video-button">
                        <a class="button" href="#videos-free">Video Instructions</a>
                    </div>
                    <h2 class="hw-heading-orange" id="step1free">Step 1 - Register<h2>
                            <p class="hw-step">Set up a detailed profile to show off your skills. Add a <a href="<?php
                            echo site_url() ?>/dashboard/payments">PayPal Email</a> to the <a href="<?php echo
                            site_url() ?>/dashboard/payments">Payments</a> section of your profile to ensure you can be
                            paid on future projects, and add a <a href="<?php echo site_url() ?>/edit-profile">Public
                            Email</a> that your soon-to-be employer can use to contact you.</p>
                            <h2 class="hw-heading-orange" id="step2free">Step 2 - Apply to Projects</h2>
                            <p class="hw-step">Apply with a detailed proposal to projects that match your skills. If you
                            choose to, you can name your price and estimated time to deliver, to give yourself
                            competitive appeal. We’ll notify you if the Employer thinks you’re the best person for the
                            project.</p>
                            <h2 class="hw-heading-orange" id="step3free">Step 3 - Accept Terms</h2>
                            <p class="hw-step">
                            <ol class="hw-list">
                                <li>When chosen for a project, you must either agree, propose, or decline the employer’s
                                initial terms for the project, which may include details such as deadlines or
                                requirements.</li>
                                <li>If you choose to negotiate project terms, the employer will need to accept, propose, or decline your terms.</li>
                                <li>Negotiate project terms until you’ve come to a mutual agreement.</li>

                            </ol>
                            </p>
                            <p class="hw-step">If the employer did not specify terms, you must hit accept to agree that
                            no terms have been set before sending it back to the employer to fund.</p>
                            <h2 class="hw-heading-orange" id="step4free">Step 4 - Await Funds</h2>
                            <p class="hw-step">Don’t start the project until funds are available; we’ll let you know
                            when the employer has completed the transaction. We hold the funds in our escrow account so
                            that we can ensure you’ll be paid correctly when the work is complete. </p>
                            <h2 class="hw-heading-orange" id="step5free">Step 5 - Work</h2>
                            <p class="hw-step">Keep in contact with the employer using their provided email while you complete the project.</p>
                            <h2 class="hw-heading-orange" id="step6free">Step 6 - End & Review</h2>
                            <p class="hw-step">When finished, mark the project Complete in the project workspace. The
                            employer will review and verify that it’s complete, and we will release payment to you. Rate
                            and review your experience working together in the project workspace. </p>
                </div>
            </div>
        </div>


        <div class="hw-videos large-10 push-1" id="videos-free">
            <h3 class="hw-header black">RCKTSHP Video Instructions</h3>

            <div class="row hw-employer-vids">
                <div class="large-4 medium-12 small-12 columns">
                    <?php
                    $width = '100%';
                    $height = '300px';

                    $url = 'https://www.youtube.com/watch?v=mTGlw0UKp8E';
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $id = $matches[1];
                    ?>
                    <div class="hw-video">
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="hw-video-info">
                        <h3>1. Signing up on RCKTSHP</h3>
                        <p>This video outlines the process of signing up on RCKTSHP.</p>
                    </div>
                </div>


                <div class="large-4 medium-12 small-12 columns">
                    <?php
                    $url = 'https://www.youtube.com/watch?v=c5TkrNMTz-w';
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $id = $matches[1];
                    ?>
                    <div class="hw-video">
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="hw-video-info">
                        <h3>2. Applying to a Project on RCKTSHP</h3>
                        <p>This video outlines the process of posting a project on RCKTSHP</p>
                    </div>
                </div>

                <div class="large-4 medium-12 small-12 columns">
                    <?php
                    $url = 'https://www.youtube.com/watch?v=ubWdx2PQB3Q';
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $id = $matches[1];
                    ?>
                    <div class="hw-video">
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                                src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="hw-video-info">
                        <h3>3. Marking project complete and Reviewing Employer</h3>
                        <p>This video outlines how a freelancer can mark their project complete, and review the employer who they completed the work for.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grey-back centered">
            <h3 class="hw-header black">More Questions? Visit our <a href="<?php echo site_url() ?>/faq/">FAQ</a>.</h3>
        </div>
    </div>



</div>


<script>

    jQuery( document ).ready(function() {
       jQuery('#how-works-freelancer-section').hide();
    });

    jQuery('#how-works-employer').click( function (){
        jQuery('#how-works-freelancer-section').hide();
        jQuery('#how-works-employer-section').show();
        jQuery('#how-works-freelancer').removeClass('current');
        jQuery('#how-works-employer').addClass('current');
    });

    jQuery('#how-works-freelancer').click( function (){
        jQuery('#how-works-employer-section').hide();
        jQuery('#how-works-freelancer-section').show();
        jQuery('#how-works-employer').removeClass('current');
        jQuery('#how-works-freelancer').addClass('current');
    });




</script>
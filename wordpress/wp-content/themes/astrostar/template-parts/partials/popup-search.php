      <div class="wpdevart-search-overlay" id="wpdevartModalContainer">
          <div class="wpdevart-search-overlay-layout">
            <form method="get" class="search-term" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="wpdevart-search-container">
                <label>
                  <input type="search" class="search-term" id="wpdevartfocusonoverlayinputwide"
                  placeholder="<?php echo esc_attr__( 'Enter a search term here...', 'astrostar'); ?>"
                  value="<?php echo esc_attr(get_search_query()); ?>" name="s"
                  />
                  <button type="submit" class="search-overlay-submit-button">
                    <svg width="22" height="32" class="wpdevart-search-overlay-icon" x="0px" y="0px" viewBox="0 -5 24 19" enable-background="new 0 -5 24 19" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                      <path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"/>
                    </svg>
				  </button>
                </label>
                <button type="button" onClick="wpdevartToggleModal()" class="search-overlay-close-wide-button" id="restoresearchbuttonfocus">
                  <svg width="40" height="40" class="search-overlay-close-icon" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="m12 10.93 5.719-5.72c.146-.146.339-.219.531-.219.404 0 .75.324.75.749 0 .193-.073.385-.219.532l-5.72 5.719 5.719 5.719c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.385-.073-.531-.219l-5.719-5.719-5.719 5.719c-.146.146-.339.219-.531.219-.401 0-.75-.323-.75-.75 0-.192.073-.384.22-.531l5.719-5.719-5.72-5.719c-.146-.147-.219-.339-.219-.532 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"/>
                  </svg>
                </button>  
                </div>
            </form>
            <div tabIndex="0"></div>
          </div>
      </div>
 
      <div class="wpdevart-search-overlay" id="wpdevartModalContainerSmall">
          <div class="wpdevart-search-overlay-layout">
              <form method="get" class="search-term" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="wpdevart-search-container">
                    <label>
                      <input type="search" class="search-term" id="wpdevartfocusonoverlayinputsmall"
                      placeholder="<?php echo esc_attr__( 'Search term...', 'astrostar'); ?>"
                      value="<?php echo esc_attr(get_search_query()); ?>" name="s"
                      />
                      <button type="submit" class="search-overlay-submit-button">
                        <svg width="22" height="20" class="wpdevart-search-overlay-icon wpdevart-search-overlay-icon-margin" x="0px" y="0px" viewBox="0 0 24 20" enable-background="new 0 0 24 20" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                          <path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"/>
                        </svg>
					  </button>
                    </label>
                    <button type="button" onClick="wpdevartToggleModalSmall()" class="search-overlay-close-button" id="restoresmallsearchbuttonfocus">
                      <svg width="40" height="40" class="search-overlay-close-icon" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="m12 10.93 5.719-5.72c.146-.146.339-.219.531-.219.404 0 .75.324.75.749 0 .193-.073.385-.219.532l-5.72 5.719 5.719 5.719c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.385-.073-.531-.219l-5.719-5.719-5.719 5.719c-.146.146-.339.219-.531.219-.401 0-.75-.323-.75-.75 0-.192.073-.384.22-.531l5.719-5.719-5.72-5.719c-.146-.147-.219-.339-.219-.532 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"/>
                      </svg>
                    </button>
                </div>
              </form>
              <div tabIndex="0"></div>
          </div>
      </div>
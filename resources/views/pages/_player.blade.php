<script type="text/javascript">
    $(document).ready(function() {
        $("#playlist").youtube_video({
//            api_key: 'AIzaSyAIyM1GnpDWhtU44zttd508uwthUZG1nDI',
            {!! $option .","!!}
//            channel: false,
//            user: false,
            videos: false,
            max_results: 8,
            shuffle: false,
            pagination: true,
            continuous: true,
            first_video: 0,
            show_playlist: 'auto',
            playlist_type: 'horizontal',
            show_channel_in_playlist:true,
            show_channel_in_title: true,
            width: false,
            show_annotations: false,
            now_playing_text: 'Ahora',
            load_more_text: 'Cargar Más',
            autoplay: false,
            force_hd: false,
            hide_youtube_logo: false,
            play_control: true,
            time_indicator: 'full',
            volume_control: true,
            share_control: true,
            fwd_bck_control: true,
            youtube_link_control: true,
            fullscreen_control: true,
            playlist_toggle_control:true,
            volume: 0,
            show_controls_on_load: true,
            show_controls_on_pause: true,
            show_controls_on_play: false,
            player_vars: {},
            colors: {
                controls_bg:      'rgba(0,0,0,.75)',
                buttons:          'rgba(255,255,255,.5)',
                buttons_hover:    'rgba(0, 174, 239,1)',
                buttons_active:   'rgba(0, 174, 239,1)',
                time_text:        '#FFFFFF',
                bar_bg:           'rgba(255,255,255,.5)',
                buffer:           'rgba(255,255,255,.25)',
                fill:             '#FFFFFF',
                video_title:      '#FFFFFF',
                video_channel:    '#00aeef',
                playlist_overlay: 'rgba(0, 174, 239,.75)',
                playlist_title:   '#FFFFFF',
                playlist_channel: '#DFF76D',
                scrollbar:        '#FFFFFF',
                scrollbar_bg:     'rgba(255,255,255,.25)',
            },

            on_load: function() {},
            on_done_loading: function() {},
            on_state_change: function() {},
            on_seek: function() {},
            on_volume: function() {},
            on_time_update: function() {},

        });
    });

</script>